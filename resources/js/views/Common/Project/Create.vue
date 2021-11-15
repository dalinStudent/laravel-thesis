<template>
    <div>
        <TemplateA
            title="Create New Project"
        >
            <template #body>
				<v-form ref="formCreate" lazy-validation>
					<v-container>
						<v-row justify="space-around">
							<v-col cols="6">
								<v-img
									v-if="profilePreview != ''"
									:src="profilePreview"
								/>
							</v-col>
						</v-row>
						<v-row>
							<v-col cols="8">
								<v-text-field
									outlined
									dense
									:error="errors.name.error"
									:messages="errors.name.message"
									v-model="project.name"
									label="Full name"
									:rules="[ v => !!v || 'Full name is required']"
									placeholder="Enter here"
								/>
							</v-col> 
							<v-col cols="4">
								<InputFile
									:value.sync="project.photo"
									:url.sync="profilePreview"
									:error="errors.photo.error"
									:messages="errors.photo.message"
									:rules="[ v => !!v || 'Photo is required']"
								/>
							</v-col>               
						</v-row>
						<v-row>
							<v-col cols="6">
								<v-text-field
									outlined
									dense
									type="date"
									:error="errors.start_date.error"
									:messages="errors.start_date.message"
									v-model="project.start_date"
									:rules="[ 
										v => !!v || 'Start date is required'
									]"
									label="Start date"
									placeholder="Enter here"
								/>
							</v-col>
							<v-col cols="6">
								<v-text-field
									outlined
									dense
									type="date"
									:error="errors.end_date.error"
									:messages="errors.end_date.message"
									v-model="project.end_date"
									label="End date"
									:rules="[ v => !!v || 'End date is required']"
									placeholder="Enter here"
								/>
							</v-col>                             
						</v-row>
						<v-row>
							<v-col cols="12">
								<v-text-field
									outlined
									dense
									:error="errors.address.error"
									:messages="errors.address.message"
									v-model="project.address"
									label="Address"
									:rules="[ v => !!v || 'End date is required']"
									placeholder="Enter here"
								/>
							</v-col>
						</v-row>
						<v-row>
							<v-col cols="12">
								<v-textarea
									v-model="project.description"
									outlined
									:error="errors.description.error"
									:messages="errors.description.message"
									placeholder="Enter here"
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
					<v-btn color="green darken-1" text outlined @click="submit()">
						Save
					</v-btn>
				</v-row>
			</template>
        </TemplateA>
    </div>
</template>
<script>
import InputFile from '@components/Input/File'
export default {
    components: {
        InputFile
    },
    data() {
        return {
            profilePreview: "",
            errors: {
                name:   	 { error: false, message: "" },
                start_date:  { error: false, message: "" },
                end_date:    { error: false, message: "" },
                address:     { error: false, message: "" },
                description:  { error: false, message: "" },
                photo:       { error: false, message: "" },
            },
            project: {
                name: 		"shhh",
                start_date: "",
                end_date: 	"",
                address: 	"sss",
                description:"sss",
                photo: 		""
            }
        }
    },
    methods: {
        closeModal() {
			this.$router.go(-1)
        },
        submit() {
            if (this.$refs.formCreate.validate()) {
                this.$chttp.post('project', this.project)
                .then( res => {
                    // this.closeModal()
                }).catch( e => {
                    if (e.response.status == 422) {
                        this.$refs.formCreate.resetValidation()
                        var keys = Object.keys(e.response.data.errors)
                        var sms = e.response.data.errors
                        Object.keys(this.errors).forEach( el => {
                            if (keys.includes(el)) {
                                this.errors[el] = {
                                    error: true,
                                    message: sms[el][0]
                                }
                            } else {
                                this.errors[el] = {
                                    error: false,
                                    message: ""
                                }
                            }
                        })
                    }
                })
            }
        },
        photoChange(file) {
            try {
                this.project.photo = file;
                this.profilePreview = URL.createObjectURL(file);
            } catch (error) {
                return
            }
        },
    },
    
}
</script>