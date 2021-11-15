<template>
    <div>
        <v-dialog
            v-model="isShow"
            persistent
            max-width="700px"
            scrollable
        >
            <v-card>
                <v-card-title class="base-bg-1">
                    <span>Edit Attendance</span>
                </v-card-title>
                <v-card-text class="pb-0">
                    <v-form ref="formEdit" lazy-validation>
                        <v-container>
                            <v-col cols="12" class="pb-0">
								<h3 class="mb-0">Morning</h3>
								<v-divider class="mt-0"/>
								<v-row>
									<v-col cols="6" class="pb-0">
										<v-text-field
											label="Check in"
											v-model="att.p1_in"
											outlined
											type="time"
											placeholder="Enter here"
											:error="errors.p1_in.error"
											:messages="errors.p1_in.message"
											clearable
											dense
										></v-text-field>
									</v-col>
									<v-col cols="6" class="pb-0">
										<v-text-field
											label="Check out"
											v-model="att.p1_out"
											outlined
											type="time"
											placeholder="Enter here"
											:error="errors.p1_out.error"
											:messages="errors.p1_out.message"
											clearable
											dense
										></v-text-field>
									</v-col>
								</v-row>
							</v-col>
							<v-col cols="12" class="pb-0">
								<h3 class="mb-0">Afternoon</h3>
								<v-divider class="mt-0"/>
								<v-row>
									<v-col cols="6" class="pb-0">
										<v-text-field
											label="Check in"
											v-model="att.p2_in"
											outlined
											type="time"
											placeholder="Enter here"
											:error="errors.p2_in.error"
											:messages="errors.p2_in.message"
											clearable
											dense
										></v-text-field>
									</v-col>
									<v-col cols="6" class="pb-0">
										<v-text-field
											label="Check out"
											v-model="att.p2_out"
											outlined
											type="time"
											placeholder="Enter here"
											:error="errors.p2_out.error"
											:messages="errors.p2_out.message"
											clearable
											dense
										></v-text-field>
									</v-col>
								</v-row>
							</v-col>
							<v-col cols="12" class="pb-0">
								<h3 class="mb-0">Overtime</h3>
								<v-divider class="mt-0"/>
								<v-row>
									<v-col cols="6" class="pb-0">
										<v-text-field
											label="Check in"
											v-model="att.p3_in"
											outlined
											type="time"
											placeholder="Enter here"
											:error="errors.p3_in.error"
											:messages="errors.p3_in.message"
											clearable
											dense
										></v-text-field>
									</v-col>
									<v-col cols="6" class="pb-0">
										<v-text-field
											label="Check out"
											v-model="att.p3_out"
											outlined
											type="time"
											placeholder="Enter here"
											:error="errors.p3_out.error"
											:messages="errors.p3_out.message"
											clearable
											dense
										></v-text-field>
									</v-col>
								</v-row>
							</v-col>
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
            attID: null,
            att: {
                p1_in: null,
                p1_out: null,
                p2_in: null,
                p2_out: null,
                p3_in: null,
                p3_out: null
            },
            errors: {
				p1_in:{error:false, message: ""},
				p1_out:{error:false, message: ""},
				p2_in:{error:false, message: ""},
				p2_out:{error:false, message: ""},
				p3_in:{error:false, message: ""},
				p3_out:{error:false, message: ""},
			}
        }
    },
    methods: {
        init(item) {
            this.attID = item.id
            this.att = {
                p1_in: item.p1_in == '--:--' ? null : item.p1_in,
                p1_out: item.p1_out == '--:--' ? null : item.p1_out,
                p2_in: item.p2_in == '--:--' ? null : item.p2_in,
                p2_out: item.p2_out == '--:--' ? null : item.p2_out,
                p3_in: item.p3_in == '--:--' ? null : item.p3_in,
                p3_out: item.p3_out == '--:--' ? null : item.p3_out,
            }
            this.isShow = true
        },
        onSaveClick() {
            var form = this.att
            Object.keys(form).forEach( el => {
                if (form[el] == null) {
                    delete form[el]
                }
			})
            this.$chttp.put('attendance/'+this.attID, form).then( () => {
                this.isShow = false
                this.$parent.init()
            }).catch( e => {
                if (e.response.status == 422) {
                    this.$refs.formEdit.resetValidation()
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