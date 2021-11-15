<template>
    <div>
        <v-dialog persistent v-model="isShow" max-width="800">
            <v-card>
                <v-card-title class="headline base-bg-1">
                    Please Enter Cridentail
                </v-card-title>
                <div class="m-4"/>
                <v-form ref="formCreate" lazy-validation>
                    <v-row class="p-0 m-0">
                        <v-col cols="12" class="pt-0 pb-0">
                            <v-text-field
                                outlined
                                dense
                                v-model="form.username"
                                label="Username"
                                placeholder="Enter here"
                                :error="errors.username.error"
                                :rules="[ v => !!v || 'Username is required']"
                                :messages="errors.username.message"
                            />
                        </v-col> 
                        <v-col cols="12" class="pt-0 pb-0">
                            <v-text-field
                                outlined
                                label="Password"
                                :rules="[ v => !!v || 'Password is required']"
                                dense
                                v-model="form.password"
                                :error="errors.password.error"
                                :messages="errors.password.message"
                                placeholder="Enter here"
                            />
                        </v-col> 
                         <v-col cols="12" class="pt-0 pb-0">
                            <v-text-field
                                outlined
                                label="Password"
                                :rules="[ v => !!v || 'Password is required']"
                                dense
                                v-model="form.password"
                                :error="errors.password.error"
                                :messages="errors.password.message"
                                placeholder="Enter here"
                            />
                        </v-col> 
                         <v-col cols="12" class="pt-0 pb-0">
                            <v-text-field
                                outlined
                                label="Password"
                                :rules="[ v => !!v || 'Password is required']"
                                dense
                                v-model="form.password"
                                :error="errors.password.error"
                                :messages="errors.password.message"
                                placeholder="Enter here"
                            />
                        </v-col> 
                    </v-row>
                </v-form>
                <v-divider class="m-0"/>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="red" text @click="isShow=false">
                        Cancel
                    </v-btn>
                    <v-btn color="success" text @click="onSaveClick()">
                        Save
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>
<script>
export default {
    data() {
        return {
            isShow: false,
            form: {
                username: 'beniten',
                password: 'beniten@007',
                role: this.$route.query.role,
                employee_id: null
            },
            errors: {
                username: { error: false, message: "" },
                password: { error: false, message: "" },
                type: { error: false, message: "" },
            }
        }
    },
    methods: {
        init(item) {
            this.form.employee_id = item.id
            this.isShow = true
        },
        onSaveClick() {
            if (this.$refs.formCreate.validate()) {
                this.$chttp.post('user',this.form).then( res => {
                    this.isShow = false
                    this.$parent.init()
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
        }
    },
}
</script>