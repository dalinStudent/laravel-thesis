<template>
    <div>
        <TemplateA
            title="Employee"
        >  
            <template #action>
				<v-btn 
					color="primary"
					@click="onAddEmployeeClick()"
				>
					Create
				</v-btn>
			</template>

            <template #body>
                <DataTable
					@change="onDataTableChange"
					:filters="filters"
					:columns="columns"
					:data="employees"
                    
				>
					<template #left>
						<v-text-field
							class="w-200 mr-2"
							outlined
							dense
							v-model="filters.keyword"
							@input="init()"
							label="Search Name"
							placeholder="Enter here"
						/>
					</template>
					<template #action="{item}">
						<v-btn
                                        class="mx-1"
                                        icon
                                        color="warning"
                                        outlined
                                        @click="onEditClick(item)"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </v-btn>
                                       <v-btn
                                        class="mx-1"
                                        icon
                                        color="warning"
                                        outlined
                                        @click="onDeleteClick(item)"
                                    >
                                        <i class="fas fa-trash"></i>
                                    </v-btn>
					</template>
				</DataTable>
            </template>
        </TemplateA>
        <ConfirmModal
            :isShow="isConfirmDelete"
            @onCancel="isConfirmDelete=false"
            @onSave="onConfirmDelete()"
        />
        <!-- <Edit ref="editModal" @refresh="init()"/>  -->
    </div>
</template>
<script>
// import Edit from './Edit'
export default {
    // props: {
    //     projectID: {
    //         default: null
    //     }
    // },
    // components: {
    //     Edit
    // },
  
    data() {
        return {
             filters: {
				page: 1,
				per_page: 20
			},
            isConfirmDelete: false,
            selectedItem: {},
            employees: {
                data: [],
                    meta: {
                        paginate: {
                            total: 0,
                            count: 0,
                            per_page: 0,
                            current_page: 0,
                            total_pages: 0
                        }
                    }
            },
            filters: {
				keyword: null
			},
            columns: [
                {
                    key: 'id',
                    label: 'ID'
                },  
				{
					key: 'name',
					label: 'Name'
				},
                 {
					key: 'sex',
					label: 'Sex'
				},
                 {
					key: 'role_id',
					label: 'Role'
				},
                {
					key: 'description',
					label: 'Description'
				},
               
			]
            
        }
    },

    /// life circle 
   
    mounted() {
        this.init()
    },

    methods: {
         onDataTableChange(val) {
            this.filters = val
            this.init()
        },
        init() {
            this.$chttp.get('employee', this.filters).then( res => {
                this.employees = res.data.data.employees
                // this.departments.data = res.data
                console.log(res);
            })
        },
        	onEditClick(item) {
			// this.$router.push({name:"admin.student.edit", {params :{id:item.id }}))
            this.$router.push({
            name: 'admin.employee.edit',
            params: { id: item.id}
    });
		},
        onAddEmployeeClick() {
            this.$router.push({
                name: 'admin.employee.create'
            })
        },
        onDeleteClick(item) {
            this.selectedItem = item
            this.isConfirmDelete = true
        },
        onConfirmDelete() {
            this.$chttp.delete('employee/'+this.selectedItem.id).then( res => {
                this.isConfirmDelete = false
                this.init()
                // console.log(res);
            })
        },
       
    }
}
</script>



