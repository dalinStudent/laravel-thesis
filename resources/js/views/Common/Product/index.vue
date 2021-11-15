<template>
    <div>
        <TemplateA
        title="List of Product"
        >  
          <template #action>
				<v-btn 
					color="primary"
					@click="onAddProductClick()"
				>
					Create
				</v-btn>
			</template>
            <template #body>
                <DataTable
					@change="onDataTableChange"
					:filters="filters"
					:columns="columns"
					:data="products"
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
                 <ConfirmModal
                :isShow="isConfirmDelete"
                @onCancel="isConfirmDelete=false"
                @onSave="onConfirmDelete()"
        />
            </template>
        </TemplateA>
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
           products: {
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
					key: 'pname',
					label: 'Name'
				},
                {
					key: 'khmer_name',
					label: 'KhmerName'
				},
                {
					key: 'model',
					label: 'Model'
				},
                {
					key: 'serialnumber',
					label: 'SerialNumber'
				},
                
                  {
					key: 'name',
					label: 'Category'
				},
                  {
					key: 'qty',
					label: 'Quality'
				},
                  {
					key: 'note',
					label: 'Note'
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
            this.$chttp.get('product',this.filters).then( res => {
                // console.log(res.data.data.products)
                this.products = res.data.data.products
            
            })
        },
      
          onAddProductClick() {
            this.$router.push({
                name: 'admin.product.create'
            })
        },
          onDeleteClick(item) {
            this.selectedItem = item
            this.isConfirmDelete = true
        },
        onConfirmDelete() {
            this.$chttp.delete('product/'+this.selectedItem.id).then( res => {
                 console.log(res);
                this.isConfirmDelete = false
                this.init()
               
            })
        },
        onEditClick(item) {
            this.$router.push({
            name: 'admin.product.edit',
            params: { id: item.id}
            
        })}
        
        
    }
}
</script>



