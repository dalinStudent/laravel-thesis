<template>
    <div>
        <TemplateA
            title="Create New Department"
        >
            <template #body>
				<v-form ref="formCreate" lazy-validation>
					<v-container>
						<v-row justify="space-around">
						
						</v-row>
						<v-row>
							<v-col cols="8">
								<v-text-field
									outlined
									dense
									v-model="department.name"
									label="Department Name"
									:rules="[ v => !!v || 'Department Name is required']"
									placeholder="Enter here"
								/>
							</v-col> 
						</v-row>
							<v-row>
							<v-col cols="8">
								<v-text-field
									outlined
									dense
									v-model="department.decription"
									label="Description"
									placeholder="Enter here"
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
			department : {
				name: ''
			}
		}
	},
	methods: {
		onSubmit() {
			if(this.$refs.formCreate.validate()) {
                this.$chttp.post('department/', this.department).then( (res) => {
					this.$router.back()
                }).catch( e => {
                })
            }
		},
		closeModal() {
			this.$router.go(-1)
        },
	}

})
</script>
