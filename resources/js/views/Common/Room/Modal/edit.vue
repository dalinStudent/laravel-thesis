<template>
	<div>
		<v-dialog
            v-model="isShow"
            persistent
            max-width="600px"
        >
            <v-card>
                <v-card-title class="base-bg-1">
                    <span>Update Room</span>
                </v-card-title>
                <v-card-text class="pb-0">
                    <v-form ref="formCreate" lazy-validation>
                        <v-container>
                            <v-col cols="12" class="pb-0">
                                <v-text-field
                                    label="Name"
                                    v-model="rooms.name"
                                    outlined
                                    placeholder="Enter here"
                                    dense
                                ></v-text-field>
                            </v-col>
                             <v-col cols="12" class="pb-0">
                                <v-text-field
                                    label="Name"
                                    v-model="rooms.description"
                                    outlined
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
			rooms: {
                name: "",
                description: ""
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
			this.rooms = this.data
		}
	},
	methods: {
		 closeModal() {
            this.$refs.formCreat.reset()
			this.isRender = false
            this.$emit("update:isShow", false);
        },
		submit() {
            if (this.$refs.formCreate.validate()) {
                this.$chttp.put('room/'+this.rooms.id, this.rooms)
                    .then( res => {
                          this.isShow = false
                        this.$parent.init()
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