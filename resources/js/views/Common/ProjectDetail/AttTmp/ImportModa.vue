<template>
    <div>
        <v-dialog
            v-model="isShow"
            persistent
            max-width="600px"
        >
            <v-card>
                <v-card-title class="base-bg-1">
                    <span>Import Data</span>
                </v-card-title>
                <v-card-text class="pb-0">
                    <v-form ref="formCreat" lazy-validation>
                        <v-container>
                            <v-file-input
                                @change="fileChange"
                                dense
                                outlined
                                label="File"
                                accept=".xls,.xlsx"
                                :error="errors.file.error"
                                :messages="errors.file.message"
                                :rules="[ v => !!v || 'File is required']"
                            >
                            </v-file-input>
                        </v-container>
                    </v-form>
                </v-card-text>
                <v-divider class="m-0"/>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="red" text @click="isShow=false">
                        Close
                    </v-btn>
                    <v-btn color="green" text @click="onSaveClick()">
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
                file: null
            },
            errors: {
                file: {error: false, message: null}
            }
        }
    },
    methods: {
        init() {
            this.isShow = true
        },
        fileChange(file) {
			if (file) {
                this.form.file = file
			}
		},
        onSaveClick() {
            var form = new FormData()
            form.append('file', this.form.file)
            this.$chttp.post('att-tmp/'+this.$route.params.id, form).then( res => {
                this.isShow = false
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
    },
}
</script>