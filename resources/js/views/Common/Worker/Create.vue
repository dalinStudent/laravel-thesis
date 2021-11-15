<template>
    <div>
		<TemplateA
			title="Create New Employee"
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
							<v-col cols="8" class="pb-0">
								<v-text-field
									outlined
									dense
									:error="errors.name.error"
									:messages="errors.name.message"
									v-model="worker.name"
									label="Name"
									:rules="[ v => !!v || 'Name is required']"
									placeholder="Enter here"
								/>
							</v-col> 
							<v-col cols="4" class="pb-0">
								<InputFile
									:value.sync="worker.photo"
									:url.sync="profilePreview"
									:error="errors.photo.error"
									:messages="errors.photo.message"
									:rules="[ v => !!v || 'Photo is required']"
								/>
							</v-col>                 
							<v-col cols="6" class="pb-0">
								<v-select
									:items="sex"
									v-model="worker.sex"
									:error="errors.sex.error"
									:messages="errors.sex.message"
									outlined
									dense
									:rules="[ v => !!v || 'Sex is required']"
									placeholder="Choose role"
									label="Sex"
								></v-select>
							</v-col>  
							<v-col cols="6" class="pb-0">
								<v-select
									:items="roles"
									v-model="worker.role_id"
									:error="errors.role_id.error"
									:messages="errors.role_id.message"
									outlined
									dense
									:rules="[ v => !!v || 'Role is required']"
									placeholder="Choose role"
									label="Role"
								></v-select>
							</v-col>  
							<v-col cols="4" class="pb-0">
								<v-text-field
									outlined
									dense
									:error="errors.hour.error"
									:messages="errors.hour.message"
									v-model="worker.hour"
									prefix="៛"
									min="0"
									type="number"
									label="Hourly Wage in Riel"
									:rules="[ v => !!v || 'Hourly Wage is required']"
									placeholder="Enter here"
								/>
							</v-col>             
							<v-col cols="8" class="pb-0">
								<v-text-field
									outlined
									dense
									:error="errors.phone_number.error"
									:messages="errors.phone_number.message"
									v-model="worker.phone_number"
									label="Phone Number"
									:rules="[ v => !!v || 'Phone Number is required']"
									placeholder="Enter here"
								/>
							</v-col>
							<v-col cols="12" class="pb-0">
								<v-textarea
									v-model="worker.description"
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
				<v-row justify="end" class="mb-1 mr-1">
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
import InputFile from '../../../components/Input/File'
export default {
	components: {
		InputFile
	},
    data() {
        return {
            profilePreview: "",
			roles: [],
			sex: [ 
				{value: 'm', text: 'Male'},
				{value: 'f', text: 'Female'}
			],
            errors: {
                name:		{ error: false, message: null },
                role_id:  	{ error: false, message: null },
                phone_number:{ error: false, message: null },
                sex:		{ error: false, message: null },
                description:{ error: false, message: null },
                photo:      { error: false, message: null },
				hour:		{ error: false, message: null }
            },
            worker: {
                name: "employee",
                role_id: "1",
                phone_number: "0987654321",
                sex: "m",
                description: "",
                photo: "",
				type: 'worker',
				hour: 0
            }
        }
    },
	mounted() {
		this.init()
	},
    methods: {
		init() {
			this.$chttp.get('master/role').then( res => {
				this.roles = res.data.data.roles
			})
		},
        closeModal() {
			this.$router.go(-1)
        },
        submit() {
            if (this.$refs.formCreate.validate()) {
                this.$chttp.post('employee', this.worker)
                .then( res => {
                    this.closeModal()
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
};
</script>