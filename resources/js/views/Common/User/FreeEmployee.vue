<template>
    <div>
        <TemplateA
            title="Free Employee"
        >
            <template #body>
                <DataTable
                    :columns="columns"
                    :filters="filters"
                    :data="employees"
                    @change="onDataTableChange"
                >
                    <template #left>
                        <v-text-field
                            class="mr-2"
                            outlined
                            dense
                            v-model="filters.keyword"
                            @input="init(false)"
                            placeholder="Enter here"
                        />
                        <v-select
                            :items="roles"
                            v-model="filters.role_id"
                            outlined
                            @change="init()"
                            dense
                            placeholder="Choose role"
                            label="Role"
                        />
                    </template>
                    <template #action="{item}">
                        <v-btn
                            color="primary"
                            outlined
                            icon
                            @click="onAddClick(item)"
                        >
                            <i class="fas fa-plus"></i>
                        </v-btn>
                    </template>
                </DataTable>
            </template>
        </TemplateA>
        
        <CridentailForm ref="cridentailForm"/>
    </div>
</template>
<script>
import CridentailForm from './CridentailFrom'
export default {
    components: {
        CridentailForm
    },
    data() {
        return {
            employees: {
                data: [],
                meta: {
                    paginate: {}
                }
            },
            filters: {
                role_id: null,
                page:1,
                per_page: 20,
                keyword: null
            },
            roles: [],
            columns: [
                {
                    key: 'name',
                    label: 'Name'
                },
                {
                    key: 'role_name',
                    label: 'Role'
                },
                {
                    key: 'phone_number',
                    label: 'Phone Number'
                }
            ]
        }
    },
    mounted() {
        this.init()
        this.getRole()
    },
    methods: {
        onDataTableChange(val) {
            this.filters = val
            this.init()
        },
        init(laoding) {
            var filters = {
                paginate: true,
                page: this.filters.page,
                per_page: this.filters.per_page,
                filters: [
                    {
                        column: 'type',
                        operator: '=',
                        value: 'worker'
                    },
                    {
                        column: 'name',
                        operator: 'like',
                        value: this.filters.keyword
                    },
                    {
                        column: 'status',
                        operator: 'in',
                        value: ['work', 'busy']
                    },
                    {
                        column: 'role_id',
                        operator: '=',
                        value: this.filters.role_id
                    }
                ]
            }
            this.$chttp.get('master/employee',filters, laoding).then( res => {
                this.employees = res.data.data.employees
            })
        },
        getRole() {
            this.$chttp.get('master/role').then( res => {
				this.roles = res.data.data.roles
                this.roles.push({
                    text: 'All',
                    value: null
                })
			})
        },
        onAddClick(item) {
            this.$refs.cridentailForm.init(item)
        }
    },
}
</script>