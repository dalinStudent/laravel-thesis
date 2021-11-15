<template>
    <div>
        <TemplateA
            title="Free Worker"
        >
            <template #body>
                <DataTable
                    :columns="columns"
                    :data="workers"
                    :filters="filter"
                >
                    <template #left>
                        <v-text-field
                            class="mr-2 w-300"
                            outlined
                            dense
                            v-model="filter.keyword"
                            @change="init()"
                            label="Search Name"
                            placeholder="Enter here"
                        />
                        <v-select
                            :items="roles"
                            v-model="filter.role_id"
                            outlined
                            dense
                            placeholder="Choose role"
                            @change="init()"
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
        <!-- <v-row justify="start" class="m-0 p-0">
			<div class="pt-2">
				<h3>Free Workersaa</h3>
			</div>
		</v-row> -->
        <!-- <v-divider/> -->
        <!-- <v-row class="m-0">
            <v-col cols="3">
                <v-text-field
                    outlined
                    dense
                    v-model="filter.keyword"
                    @input="getFreeWroker()"
                    label="Search Name"
                    placeholder="Enter here"
                />
            </v-col> 
            <v-col cols="2">
                <v-select
                    :items="roles"
                    v-model="filter.role_id"
                    outlined
                    dense
                    placeholder="Choose role"
                    @change="getFreeWroker()"
                    label="Role"
                ></v-select>
            </v-col> 
		</v-row> -->
        <!-- <div class="table-con-border">
			<v-simple-table>
				<thead>
					<tr>
						<td>Name</td>
						<td>Role</td>
                        <td>Sex</td>
                        <td>Phone Number</td>
						<td>Action</td>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(item,index) in workers.data" :key="index">
						<td>{{ item.name }}</td>
						<td>{{ item.role_name }}</td>
                        <td>{{ item.sex }}</td>
                        <td>{{ item.phone_number }}</td>
						<td>
                            <v-btn
                                color="primary"
                                outlined
                                icon
                                @click="onAddClick(item)"
                            >
                                <i class="fas fa-plus"></i>
                            </v-btn>
						</td>
					</tr>
				</tbody>
			</v-simple-table>
            <div class="text-center p-3" v-if="!workers.data.length">
				<h1>No result</h1>
			</div>
		</div> -->
        <!-- <div class="text-center pt-3">
            <v-pagination
                color="red"
                @input="init()"
                v-model="filter.page"
                :length="workers.meta.paginate.total_pages"
            ></v-pagination>
        </div> -->
        <!-- <v-row justify="end" class="mb-1 mr-1">
			<v-btn color="red darken-1" class="mr-1" text outlined @click="onBackClick()">
				Back
			</v-btn>
		</v-row> -->
        <Modal ref="modal" @refresh="init()"/>
    </div>
</template>
<script>
import Modal from './Modal'
import DataTable from '@components/Table/DataTable'
export default {
    components: {
        Modal,
        DataTable
    },
    data() {
        return {
            workers: {
                data: [],
                meta: {
                    paginate: {}
                }
            },
            roles: [],
            filter: {
                page: 1,
                role_id: null,
                keyword: null,
                project_id: this.$route.params.id,
                per_page: 20
            },
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
                    key: 'sex',
                    label: 'Sex'
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
        init() {
            this.$chttp.get('project-employee/free', this.filter).then( res => {
                this.workers = res.data.data.employees
                
            })
        },
        getRole() {
            this.$chttp.get('master/role','',false).then( res => {
                this.roles = res.data.data.roles
                this.roles.push({
                    value: null,
                    text: 'ALL'
                })
            })
        },
        onAddClick(item) {
            this.$refs.modal.init(item)
        },
    },
}
</script>