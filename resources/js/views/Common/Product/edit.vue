<template>
    <div>
        <TemplateA
            title="Update Product"
        >
            <template #body>
				<v-form ref="formEdit" lazy-validation>
					<v-container>
						<v-row justify="space-around">
						</v-row>
						<v-row>
							<v-col cols="4" class="pb-0">
								<v-text-field
									outlined
									dense
									v-model="product.name"
									label="Product Name"
									:rules="[ v => !!v || 'Product Name is required']"
									placeholder="Enter here"
								/>
							</v-col> 
								<v-col cols="4" class="pb-0">
								<v-text-field
									v-model="product.khmer_name"
									outlined
									dense
									:rules="[ v => !!v || 'Khmer Name is required']"
									placeholder="Khmer Name"
									label="Khmer Name"
									/>
							</v-col>
							<v-col cols="2" class="pb-0">
								<v-text-field
									v-model="product.model"
									outlined
									dense
									:rules="[ v => !!v || 'Modal is required']"
									placeholder="Model"
									label="Model"
									/>
							</v-col> 
							<v-col cols="2" class="pb-0">
								<v-text-field
									v-model="product.serialnumber"
									outlined
									dense
									:rules="[ v => !!v || 'Serial Number is required']"
									placeholder="Serial Number"
									label="Serial Number"
									/>
							</v-col>  
				
							<v-col cols="4" class="pb-0" >
									<v-autocomplete
                                    v-model="product.category_id"
                                    :items="items"
                                    item-value="value"
                                    item-text="text"
                                    outlined
                                    dense
                                    label="Category"
                                ></v-autocomplete>
								
							</v-col> 
						
							<v-col cols="2" class="pb-0">
								<v-text-field
									outlined
									dense
									v-model="product.qty"
									label="Qty"
									:rules="[ v => !!v || 'Qty is required']"
									placeholder="Enter here"
								/>
							</v-col> 
								<v-col cols="2" class="pb-0">
									<v-text-field
									v-model="product.note"
									outlined
									dense
									placeholder="Note"
									label="Note"
								/>
							
							</v-col> 
						
							
							
								
						</v-row>
						
							<!-- <v-col cols="4">
								<InputFile
									:value.sync="project.photo"
									:url.sync="profilePreview"
									:error="errors.photo.error"
									:messages="errors.photo.message"
									:rules="[ v => !!v || 'Photo is required']"
								/>
							</v-col>                -->
						
					</v-container>
				</v-form>
				<v-row justify="end" class="m-0 mr-2">
					<v-btn color="red darken-1" class="mr-1" text outlined @click="closeModal()">
						Cancel
					</v-btn>
					<v-btn color="green darken-1" text outlined @click="onSubmit()">
						Save
					</v-btn>
				</v-row>
			</template>
        </TemplateA>
    </div>
</template>
<script>

export default ({
	data() {
		return {
			product : {
				name: '',
                	description: '',
					qty:'',
					category_id : '',
					khmer_name:''
			},
			items: [
				{value: 1, text: 'Morning'}
			]
		}
	},
	methods: {
		onSubmit() {
			if(this.$refs.formEdit.validate()) {
                this.$chttp.put(`product/${this.$route.params.id}`, this.product).then( (res) => {
					this.$router.back()
                }).catch( e => {
                })
            }
		},
		closeModal() {
			this.$router.go(-1)
        },
        	init() {
            this.$chttp.get('product' + "/" + this.$route.params.id).then( res => {
                     this.product = res.data[0]
					//  console.log(res.data)
            })
        },
		getallcategory() {
            this.$chttp.get("product/getallcategoryname").then(res => {
                this.items = res.data.map(res => {
                    return {
                        text: res.name,
                        value: (res.id).toString()
                    };
                });	
                // console.log(res);
            });
        }
	},
    created(){
        this.init();
		this.getallcategory();
       
    }

})
</script>
