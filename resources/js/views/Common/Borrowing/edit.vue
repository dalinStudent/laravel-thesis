<template>
    <div>
        <TemplateA title="Update Borrowing">
            <template #body>
                <v-form ref="formEdit" lazy-validation>
                    <v-container>
                        <v-row justify="space-around"> </v-row>
                        <v-row>
                            <v-col cols="4" class="pb-0">
                                <v-autocomplete
                                    v-model="borrowingproduct.product_id"
                                    :items="items1"
                                    item-value="value"
                                    item-text="text"
                                    outlined
                                    dense
                                    label="ProductName"
                                ></v-autocomplete>
                            </v-col>
                            <v-col cols="6" class="pb-0">
                                <v-autocomplete
                                    v-model="borrowingproduct.user_id"
                                    :items="items3"
                                    item-value="value"
                                    item-text="text"
                                    outlined
                                    dense
                                    label="Student Name"
                                ></v-autocomplete>
                            </v-col>
                            <v-col cols="2" class="pb-0">
                                <v-text-field
                                    v-model="borrowingproduct.qty"
                                    outlined
                                    dense
                                    :rules="[v => !!v || 'Qty is required']"
                                    placeholder="Enter Qty"
                                    label="Qty"
                                />
                            </v-col>

                            <v-col cols="4" class="pb-0">
                                <v-text-field
                                    outlined
                                    dense
                                    v-model="borrowingproduct.start_datetime"
                                    label="StartDateTime"
                                    type="time"
                                    form
                                    :rules="[
                                        v => !!v || 'StartDate is required'
                                    ]"
                                    placeholder="Choose here"
                                />
                            </v-col>

                            <v-col cols="4" class="pb-0">
                                <v-text-field
                                    outlined
                                    dense
                                    v-model="borrowingproduct.end_datetime"
                                    type="time"
                                    label="End DateTime"
                                    :rules="[
                                        v => !!v || 'End DateTime is required'
                                    ]"
                                    placeholder="Choose here"
                                />
                            </v-col>
                            <v-col cols="2" class="pb-0">
                                <v-autocomplete
                                    v-model="borrowingproduct.room_id"
                                    :items="items2"
                                    item-value="value"
                                    item-text="text"
                                    outlined
                                    dense
                                    label="Room"
                                ></v-autocomplete>
                            </v-col>
                            <v-col cols="2" class="pb-0">
                                <v-select
                                    outlined
                                    :items="status"
                                    dense
                                    v-model="borrowingproduct.status"
                                    item-value="value"
                                    item-text="text"
                                    label="Status"
                                    placeholder="Choose here"
                                ></v-select>
                            </v-col>
                            <v-col cols="12" class="pb-0">
                                <v-textarea
                                    outlined
                                    dense
                                    v-model="borrowingproduct.note"
                                    label="Note"
                                    placeholder="Note"
                                />
                            </v-col>
                        </v-row>

                        <!-- <v-col cols="4">
								<InputFile
									:value.sync="project.photo"
									:url.sync="profilePreview"
									:error="errors.photo.error"
									:messages="errors.photo.message"
									:rules="[ v => !!v || 'Photo is required']"
								/>
							</v-col>                -->
                    </v-container>
                </v-form>
                <v-row justify="end" class="m-0 mr-2">
                    <v-btn
                        color="red darken-1"
                        class="mr-1"
                        text
                        outlined
                        @click="closeModal()"
                    >
                        Cancel
                    </v-btn>
                    <v-btn
                        color="green darken-1"
                        text
                        outlined
                        @click="onSubmit()"
                    >
                        Save
                    </v-btn>
                </v-row>
            </template>
        </TemplateA>
    </div>
</template>
<script>
export default {
    data() {
        return {
            borrowingproduct: {
				room_id:"",
				note:"",
				status:"",
				qty:""


            },

            status: [
                { value: "borrowing", text: "Borrowing" },
                { value: "return", text: "Return" },
                { value: "cancel", text: "Cancel" }
            ],
			items1: [
				{value: 1, text: 'Morning'}
			],
			items2: [
				{value: 1, text: 'Morning'}
			],
			items3: [
				{value: 1, text: 'Morning'}
			]

        };
    },
    methods: {
        onSubmit() {
            if (this.$refs.formEdit.validate()) {
                this.$chttp
                    .put(`borrowingproduct/update-status/${this.$route.params.id}`, this.borrowingproduct)
                    .then(res => {
                        this.$router.back();
                    })
                    .catch(e => {});
            }
        },
        closeModal() {
            this.$router.go(-1);
        },
         init() {
            this.$chttp
                .get("borrowingproduct" + "/" + this.$route.params.id)
                .then(res => {
                    this.borrowingproduct = res.data;
                    // this.borrowingproduct = res.data.data.products
                    //  console.log(res.data);
                });
        },
        getallproduct() {
            this.$chttp.get("borrowingproduct/getallproduct").then(res => {
                this.items1 = res.data.map(res => {
                    return {
                        text: res.name,
                        value: res.id
                    };
                });
                console.log(res);
            });
        },
        getallroom() {
            this.$chttp.get("borrowingproduct/getallroom").then(res => {
                this.items2 = res.data.map(res => {
                    return {
                        text: res.name,
                        value: res.id
                    };
                });
                // console.log(res);
            });
        },
        getallstudent() {
            this.$chttp.get("borrowingproduct/getallstudent").then(res => {
                this.items3 = res.data.map(res => {
                    return {
                        text: res.name,
                        value: res.id
                    };
                });
                // console.log(res);
            });
        }
    },
    created() {
        this.init();
        this.getallstudent();
        this.getallroom();
        this.getallproduct();
        
    }
};
</script>
