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
                    <span>Edit {{ dayName }}</span>
                </v-card-title>
                <v-card-text class="pb-0">
                    <v-form ref="formEdit" lazy-validation>
                        <v-container>
                            <v-col cols="12" class="pb-0">
								<h5 class="mb-0">Morning</h5>
								<v-divider class="mt-0"/>
								<v-row>
									<v-col cols="6" class="pb-0">
										<v-text-field
											label="Check in"
											v-model="schedule.p1_in"
											outlined
											type="time"
											placeholder="Enter here"
											:error="errors.p1_in.error"
											:messages="errors.p1_in.message"
											dense
										></v-text-field>
									</v-col>
									<v-col cols="6" class="pb-0">
										<v-text-field
											label="Check out"
											v-model="schedule.p1_out"
											outlined
											type="time"
											placeholder="Enter here"
											:error="errors.p1_out.error"
											:messages="errors.p1_out.message"
											dense
										></v-text-field>
									</v-col>
								</v-row>
							</v-col>
							<v-col cols="12" class="pb-0">
								<h5 class="mb-0">Afternoon</h5>
								<v-divider class="mt-0"/>
								<v-row>
									<v-col cols="6" class="pb-0">
										<v-text-field
											label="Check in"
											v-model="schedule.p2_in"
											outlined
											type="time"
											placeholder="Enter here"
											:error="errors.p2_in.error"
											:messages="errors.p2_in.message"
											dense
										></v-text-field>
									</v-col>
									<v-col cols="6" class="pb-0">
										<v-text-field
											label="Check out"
											v-model="schedule.p2_out"
											outlined
											type="time"
											placeholder="Enter here"
											:error="errors.p2_out.error"
											:messages="errors.p2_out.message"
											dense
										></v-text-field>
									</v-col>
								</v-row>
							</v-col>
							<v-col cols="12" class="pb-0">
								<h5 class="mb-0">Overtime</h5>
								<v-divider class="mt-0"/>
								<v-row>
									<v-col cols="6" class="pb-0">
										<v-text-field
											label="Check in"
											v-model="schedule.p3_in"
											outlined
											type="time"
											placeholder="Enter here"
											:error="errors.p3_in.error"
											:messages="errors.p3_in.message"
											dense
										></v-text-field>
									</v-col>
									<v-col cols="6" class="pb-0">
										<v-text-field
											label="Check out"
											v-model="schedule.p3_out"
											outlined
											type="time"
											placeholder="Enter here"
											:error="errors.p3_out.error"
											:messages="errors.p3_out.message"
											dense
										></v-text-field>
									</v-col>
								</v-row>
							</v-col>
                            <v-col cols="12" class="pb-0">
								<h5 class="mb-0">Rate</h5>
								<v-divider class="mt-0"/>
								<v-row>
									<v-col cols="6" class="pb-0">
										<v-text-field
											label="Normale Time Rate"
											v-model="schedule.nt_rate"
											outlined
											type="number"
                                            :rules="[ v => v >= 1 || 'Must better than 0']"
                                            min="1"
											placeholder="Enter here"
											:error="errors.nt_rate.error"
											:messages="errors.nt_rate.message"
											dense
										></v-text-field>
									</v-col>
									<v-col cols="6" class="pb-0">
										<v-text-field
                                            :rules="[ v => v >= 1 || 'Must better than 0']"
											label="Overtime Rate"
											v-model="schedule.ot_rate"
											outlined
                                            min="1"
											type="number"
											placeholder="Enter here"
											:error="errors.ot_rate.error"
											:messages="errors.ot_rate.message"
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
            id: null,
            dayName: null,
            schedule: {
                p1_in: null,
                p1_out: null,
                p2_in: null,
                p2_out: null,
                p3_in: null,
                p3_out: null,
                nt_rate: 1,
                ot_rate: 1
            },
            errors: {
                p1_in: {error: false, message: null},
                p1_out: {error: false, message: null},
                p2_in: {error: false, message: null},
                p2_out: {error: false, message: null},
                p3_in: {error: false, message: null},
                p3_out: {error: false, message: null},
                nt_rate: {error: false, message: null},
                ot_rate: {error: false, message: null}
            }
        }
    },
    methods: {
        init(item) {
            this.isShow = true
            this.dayName = item.name
            this.id = item.id
            this.schedule = {
                p1_in: item.p1_in,
                p1_out: item.p1_out,
                p2_in: item.p2_in,
                p2_out: item.p2_out,
                p3_in: item.p3_in,
                p3_out: item.p3_out,
                nt_rate: item.nt_rate,
                ot_rate: item.ot_rate
            }
        },
        onSaveClick() {
            if(this.$refs.formEdit.validate()) {
                this.$chttp.put('schedule/'+this.id, this.schedule).then( () => {
                    this.isShow = false
                    this.$emit('refresh')
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
        }
    },
}
</script>