<template>
	<div>
		<v-dialog
            v-model="isShow"
            persistent
            max-width="600px"
        >
            <v-card>
                <v-card-title class="base-bg-1">
                    <span>Create New Role</span>
                </v-card-title>
                <v-card-text class="pb-0">
                    <v-form ref="formCreat" lazy-validation>
                        <v-container>
                            <v-col cols="12" class="pb-0">
                                <v-text-field
                                    label="Name"
                                    :rules="[ v => !!v || 'Role name is required']"
                                    v-model="role.name"
                                    outlined
                                    :error="errors.name.error"
                                    :messages="errors.name.message"
                                    placeholder="Enter here"
                                    dense
                                ></v-text-field>
                            </v-col>
                        </v-container>
                    </v-form>
                </v-card-text>
                <v-divider class="m-0"/>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="red" text @click="closeModal()">
                        Close
                    </v-btn>
                    <v-btn color="green" text @click="submit()">
                        Save
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
	</div>
</template>
<script>
export default {
	props:{
		isShow: {
			type: Boolean,
			default: false
		},
		data: {
			type: Object,
			default() {
				return {}
			}
		}
	},
	data() {
		return {
			isRender: false,
			role: {
                name: ""
            },
            errors: {
                name:{
                    error: false,
                    message: ""
                }
            }
		}
	},
	updated() {
		if (this.isShow && !this.isRender) {
			this.isRender = true
			this.role = this.data
		}
	},
	methods: {
		closeModal() {
            this.$refs.formCreat.reset()
			this.isRender = false
            this.$emit("update:isShow", false);
        },
		submit() {
            if (this.$refs.formCreat.validate()) {
                this.$chttp.d('role/'+this.role.id, this.role)
                    .then( res => {
                        this.closeModal()
						this.isRender = false
                        this.$emit('refresh')
                    }).catch((e) => {
                        if (e.response.status == 422) {
                            this.$refs.formCreat.resetValidation()
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
                    }
				);
            }
        }
	},
}
</script>