<template>
    <div>
        <TemplateA
        title="List of Category"
        >  
          <template #action>
				<v-btn 
					color="primary"
					@click="onAddCategoryClick()"
				>
					Create
				</v-btn>
			</template>
            <template #body>


                <DataTable
					@change="onDataTableChange"
					:filters="filters"
					:columns="columns"
					:data="categorys"
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
                <!-- <div class="my-table">
                    <table>
                        <thead>
                            <tr>
                                <td rowspan="">ID</td>
                                <td colspan="">Name</td>
                                 <td rowspan="">Description</td>
                                 <td></td>
                                
                             
                              
                            </tr>
                           
                        </thead>
                        <tbody>
                            <tr v-for="(item,index) in categorys" :key="index">
                                <td>{{ item.id }}</td>
                                <td>{{ item.name }}</td>
                                  <td>{{ item.description }}</td>
                                  
                             
                                <td>
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
                                        @click="onEditClick(item)"
                                    >
                                        <i class="fas fa-trash"></i>
                                    </v-btn>
                                </td>
                                
                            </tr>
                        </tbody>
                    </table>
                </div> -->
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
             isConfirmDelete: false,
             filters: {
				page: 1,
				per_page: 20
			},
           categorys: {
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
            this.$chttp.get('category', this.filters).then( res => {
            this.categorys = res.data.data.categories
            })
        },
          onEditClick(item) {
            this.$router.push({
            name: 'admin.category.edit',
            params: { id: item.id}
            
        })
          },
        
          onAddCategoryClick() {
            this.$router.push({
                name: 'admin.category.create'
            })
        },
          onDeleteClick(item) {
            this.selectedItem = item
            this.isConfirmDelete = true
        },
        onConfirmDelete() {
            this.$chttp.delete('category/'+this.selectedItem.id).then( res => {
                this.isConfirmDelete = false
                this.init()
                // console.log(res);
            })
        }
        
    },
}
</script>



