<template>
    <div>
        <TemplateA
            title="Update Department Information"
        >
            <template #body>
				<v-form ref="formEdit" lazy-validation>
					<v-container>
						<v-row justify="space-around">
						</v-row>
						<v-row>
							<v-col cols="6" class="pb-0">
								<v-text-field
									outlined
									dense
									v-model="department.name"
									label="Department Name"
									:rules="[ v => !!v || 'Product Name is required']"
									placeholder="Enter here"
								/>
							</v-col> 
								<v-col cols="6" class="pb-0">
								<v-text-field
									v-model="department.description"
									outlined
									dense
									placeholder="Description"
									label="Description"
									/>
							</v-col> 
				
						</v-row>
						
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
			department : {
				name: '',
                description: ''
			},	
		}
	},
	methods: {
		onSubmit() {
			if(this.$refs.formEdit.validate()) {
                this.$chttp.put(`department/${this.$route.params.id}`, this.department).then( (res) => {
					this.$router.back()
                }).catch( e => {
                })
            }
		},
		closeModal() {
			this.$router.go(-1)
        },
        	init() {
            this.$chttp.get('department' + "/" + this.$route.params.id).then( res => {
                     this.department = res.data
					//  console.log(res.data)
            })
        }
		
	},
    created(){
        this.init();
	
       
    }

})
</script>
