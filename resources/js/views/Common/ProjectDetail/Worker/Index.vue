<template>
    <div>
        <DataTable
           :columns="columns"
           :data="employees"
           :filters="filters"
           @change="onDataTableChange"
        >
            <template #left>
                <v-text-field
                    outlined
                    dense
                    v-model="filters.keyword"
                    @input="init()"
                    label="Search Name"
                    placeholder="Enter here"
                    class="w-300 mr-2"
                />
                 <v-select
                    :items="roles"
                    v-model="filters.role_id"
                    outlined
                    @change="init()"
                    dense
                    placeholder="Choose role"
                    label="Role"
                    class="w-300 mr-2"
                />
                <v-select
                    :items="statuses"
                    v-model="filters.status"
                    outlined
                    @change="init()"
                    dense
                    placeholder="Choose Status"
                    label="Status"
                    class="w-150 mr-2"
                />
            </template>
            <template #right>
                <v-btn 
                    color="primary"
                    class="mr-2"
                    @click="onAddNewWorkerClick()"
                >
                    Add New Worker
                </v-btn>
                <v-btn 
                    color="success"
                    @click="onViewCardClick()"
                >
                    View Card
                </v-btn>
            </template>
            <template #action="{item}">
                <v-btn
                    v-if="item.status == 'work'"
                    color="error"
                    outlined
                    icon
                    @click="onRemoveClick(item)"
                >
                    <i class="fas fa-times"></i>
                </v-btn>
                <v-btn
                    v-else
                    color="success"
                    outlined
                    icon
                    @click="onRemoveClick(item)"
                >
                    <i class="fas fa-sync"></i>
                </v-btn>
                <v-btn
                    class="mx-1"
                    icon
                    color="primary"
                    outlined
                    @click="onMoreClick(item)"
                >
                    <i class="fas fa-ellipsis-h"></i>
                </v-btn>
            </template>
        </DataTable>
        <ConfirmModal
            :isShow.sync="isRemoveShow"
            @onSave="onSaveRemoveClick"
        />
    </div>
</template>
<script>
export default {
    mounted() {
        this.init()
        this.getRole()
    },
    data() {
        return {
            isRemoveShow: false,
            selectedEmployee:{},
            roles: [],
            statuses: [
                {text: 'Working', value: 'work'},
                {text: 'Stoped', value: 'stop'}
            ],
            filters: {
                keyword: null,
                project_id: this.$route.params.id,
                role_id: null,
                status: 'work',
                page: 1,
                per_page: 20
            },
            employees: {
                data: [],
                meta: {
                    paginate: {}
                }
            },
            columns: [
                {
                    key: 'local_id',
                    label: 'ID'
                },
                {
                    key: 'employee.name',
                    label: 'Name'
                },
                {
                    key: 'employee.role_name',
                    label: 'Role'
                },
                {
                    key: 'employee.phone_number',
                    label: 'Phone Number'
                }
            ]
        }
    },
    methods: {
        init() {
            this.$chttp.get('project-employee', this.filters).then( res => {
                this.employees= res.data.data.employees
            })
        },
        onDataTableChange(val) {
            this.filters = val
            this.init()
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
        onAddNewWorkerClick() {
            this.$router.routeTo({
                name: 'worker.free',
                params: {
                    id: this.$route.params.id
                }
            })
        },
        onRemoveClick(item) {
            this.selectedEmployee = item
            this.isRemoveShow = true
        },
        onSaveRemoveClick() {
            this.$chttp.put('project-employee/'+this.selectedEmployee.id).then( res => {
                this.isRemoveShow = false
                this.init()
            })
        },
        onMoreClick(item) {
			this.$router.routeTo({
				name: 'employee.detail',
				params: {
					id: item.id
				}
			})
		},
        onViewCardClick() {
            this.$router.routeTo({
                name: 'project.card',
                params: {
                    id: this.$route.params.id
                }
            })
        }
    },
}
</script>