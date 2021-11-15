<template>
    <div>
        <v-dialog persistent v-model="isShow" max-width="500">
            <v-card>
                <v-card-title class="headline base-bg-1">
                    Please select week
                </v-card-title>
                <v-form ref="formCreate" lazy-validation>
                    <v-col>
                        <v-select
                            :items="project"
                            outlined
                            v-model="selectProjectID"
                            dense
                            :rules="[ v => !!v || 'Project is required']"
                            :error="errors.to_project_id.error"
                            :messages="errors.to_project_id.message"
                            label="Project"
                        />
                        <v-text-field
                            outlined
                            dense
                            v-model="msg"
                            label="Message"
                            :rules="[ v => !!v || 'Message is required']"
                            :error="errors.msg.error"
                            :messages="errors.msg.message"
                            placeholder="Enter here"
                        />
                    </v-col>
                </v-form>
                <v-divider class="m-0"/>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="red" text @click="onCancel()">
                        Cancel
                    </v-btn>
                    <v-btn color="green" text @click="onSave()">
                        Save
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>
<script>
export default {
    props: {
        attCheckIDs: {
            type: Array,
            default: []
        }
    },
    data() {
        return {
            isShow: false,
            project: [],
            selectProjectID: null,
            msg: null,
            errors: {
                to_project_id: {error: false, message: null},
                msg: {error: false, message: null}
            }
        }
    },
    methods: {
        init() {
            this.isShow = true
            this.$chttp.get(`sending-attendance/${this.$route.params.id}/project`).then( res => {
                this.project = res.data.data.projects
            })
        },
        onCancel() {
            this.isShow = false
        },
        onSave() {
            if (this.$refs.formCreate.validate()) {
                this.$chttp.post(`sending-attendance/${this.$route.params.id}`, {
                    to_project_id: this.selectProjectID,
                    id: this.attCheckIDs,
                    msg: this.msg
                }).then( res => {
                    this.onCancel()
                    this.$emit('onSuccess')
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