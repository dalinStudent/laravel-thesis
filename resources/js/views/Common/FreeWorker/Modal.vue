<template>
    <v-dialog persistent v-model="isShow" max-width="400">
        <v-card>
            <v-card-title class="headline base-bg-1">
                Please Enter ID
            </v-card-title>
            <v-divider class="m-0"/>
            <v-form ref="formCreat">
                <v-col class="my-0">
                    <v-text-field
                        outlined
                        dense
                        :error="errors.local_id.error"
                        :messages="errors.local_id.message"
                        v-model="form.local_id"
                        label="ID"
                        type="number"
                        :rules="[ v => !!v || 'ID is required']"
                        placeholder="Enter here"
                    />
                </v-col> 
            </v-form>
            <v-divider class="m-0"/>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="red" text @click="onCancelClick()">
                    Cancel
                </v-btn>
                <v-btn color="green" text @click="onSaveClick()">
                    Save
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script>
export default {
    data() {
        return {
            isShow: false,
            form: {
                local_id: null,
                employee_id: null,
                project_id: null
            },
            errors: {
                local_id:{error:false, message: null}
            }
        }
    },
    methods: {
        init(item) {
            this.isShow = true
            this.form = {
                local_id: null,
                employee_id: item.id,
                project_id: this.$route.params.id
            }
        },
        onCancelClick() {
            this.isShow = false
            this.form.local_id = null
            this.$refs.formCreat.resetValidation()
            Object.keys(this.errors).forEach( el => {
                this.errors[el] = {
                    error: false,
                    message: ""
                }
            })
        },
        onSaveClick() {
            if (this.$refs.formCreat.validate()) {
                this.$chttp.post('project-employee', this.form).then( () => {
                    this.onCancelClick()
                    this.$emit('refresh')
                }).catch( e => {
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
                })
            }
        }
    },
}
</script>