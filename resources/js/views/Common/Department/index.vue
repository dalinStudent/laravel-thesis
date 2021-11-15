<template>
    <div>
        <TemplateA
            title="Department"
        >  
            <template #action>
				<v-btn 
					color="primary"
					@click="onAddDepartmentClick()"
				>
					Create
				</v-btn>
			</template>

            <template #body>
                <DataTable
					@change="onDataTableChange"
					:filters="filters"
					:columns="columns"
					:data="departments"
                    
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
            departments: {
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
            this.$chttp.get('department', this.filters).then( res => {
                this.departments = res.data.data.departments
                // this.departments.data = res.data
                console.log(res);
            })
        },
        	onEditClick(item) {
			// this.$router.push({name:"admin.student.edit", {params :{id:item.id }}))
            this.$router.push({
            name: 'admin.department.edit',
            params: { id: item.id}
    });
		},
        onAddDepartmentClick() {
            this.$router.push({
                name: 'admin.department.create'
            })
        },
        onDeleteClick(item) {
            this.selectedItem = item
            this.isConfirmDelete = true
        },
        onConfirmDelete() {
            this.$chttp.delete('department/'+this.selectedItem.id).then( res => {
                this.isConfirmDelete = false
                this.init()
                // console.log(res);
            })
        },
       
    }
}
</script>



