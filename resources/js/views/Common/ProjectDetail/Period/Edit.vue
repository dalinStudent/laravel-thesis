<template>
    <div>
        <v-dialog persistent v-model="isShow" max-width="600">
            <v-card>
                <v-card-title class="headline base-bg-1">
                    Edit
                </v-card-title>
				<v-divider/>
                <v-form ref="formCreate" lazy-validation>
                    <v-row class="p-0 m-0">
                        <v-col cols="12" class="pt-0 pb-0">
                            <v-text-field
                                outlined
                                dense
                                label="Username"
                                placeholder="Enter here"
                                :rules="[ v => !!v || 'Name is required']"
                                v-model="period.name"
                                :error="errors.name.error"
                                :messages="errors.name.message"
                            />
                        </v-col> 
                        <v-col cols="12" class="pt-0 pb-0">
                            <v-text-field
                                outlined
                                type="date"
                                label="From Date"
                                :rules="[ v => !!v || 'From Date is required']"
                                dense
                                v-model="period.from_date"
                                :error="errors.from_date.error"
                                :messages="errors.from_date.message"
                                placeholder="Enter here"
                            />
                        </v-col>
                        <v-col cols="12" class="pt-0 pb-0">
                            <v-text-field
                                outlined
                                type="date"
                                label="To Date"
                                :rules="[ v => !!v || 'From Date is required']"
                                dense
                                v-model="period.to_date"
                                placeholder="Enter here"
                                :error="errors.to_date.error"
                                :messages="errors.to_date.message"
                            />
                        </v-col> 
                    </v-row>
                </v-form>
                <v-divider class="m-0"/>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="red" text @click="onCanCelClick()">
                        Cancel
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
            periodID: null,
            period: {
                name: null,
                from_date: null,
                to_date: null,
                type: 'week',
                project_id: this.$route.params.id
            },
            errors: {
                name: {error: false, message: null},
                from_date: {error: false, message: null},
                to_date: {error: false, message:null}
            }
        }
    },
    methods: {
        init(item) {
            this.isShow = true
            this.periodID = item.id
            this.period = {
                name: item.name,
                from_date: item.from_date,
                to_date: item.to_date,
                project_id: item.project_id
            }
        },
        onCanCelClick() {
            this.isShow = false
        },
        onSaveClick() {
            if (this.$refs.formCreate.validate()) {
                this.$chttp.put('period/'+this.periodID, this.period).then( res => {
                    this.$parent.init()
                    this.isShow = false
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