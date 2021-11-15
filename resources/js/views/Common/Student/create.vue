<template>
    <div>
        <TemplateA title="Create New Student">
            <template #body>
                <v-form ref="formCreate" lazy-validation>
                    <v-container>
                        <v-row justify="space-around"> </v-row>
                        <v-row>
                            <v-col cols="4" class="pb-0">
                                <v-text-field
                                    outlined
                                    dense
                                    v-model="student.name"
                                    label="Student Name"
                                    :rules="[
                                        v => !!v || 'Student Name is required'
                                    ]"
                                    placeholder="Enter here"
                                />
                            </v-col>
                            <v-col cols="2" class="pb-0">
                                <v-text-field
                                    outlined
                                    dense
                                    v-model="student.idcard"
                                    label="IDCard"
                                    :rules="[v => !!v || 'IDCard is required']"
                                    placeholder="Enter here"
                                />
                            </v-col>
                            <v-col cols="2" class="pb-0">
                                <v-select
                                    :items="sex"
                                    v-model="student.gender"
                                    outlined
                                    dense
                                    :rules="[v => !!v || 'Sex is required']"
                                    placeholder="Choose role"
                                    label="Sex"
                                ></v-select>
                            </v-col>

                            <v-col cols="4" class="pb-0">
                                <v-text-field
                                    outlined
                                    dense
                                    v-model="student.DOB"
                                    label="DOB"
                                    type="date"
                                    form
                                    :rules="[v => !!v || 'DOB is required']"
                                    placeholder="Enter here"
                                />
                            </v-col>

                            <v-col cols="2" class="pb-0">
                                <!-- <v-text-field
									outlined
									dense
									v-model="student.department_id"
									label="Department Name"
									:rules="[ v => !!v || 'Student Name is required']"
									placeholder="Enter here"
								/> -->

                                <v-autocomplete
                                    v-model="student.department_id"
                                    :items="items"
                                    item-value="value"
                                    item-text="text"
                                    outlined
                                    dense
                                    label="Department Name"
                                ></v-autocomplete>
                            </v-col>

                            <v-col cols="2" class="pb-0">
                                <v-select
                                    :items="shift"
                                    v-model="student.shift"
                                    outlined
                                    dense
                                    :rules="[v => !!v || 'Sex is required']"
                                    placeholder="Choose Shift"
                                    label="Shift"
                                ></v-select>
                            </v-col>
                            <v-col cols="2" class="pb-0">
                                <v-text-field
                                    outlined
                                    dense
                                    v-model="student.year"
                                    label="Year"
                                    :rules="[v => !!v || 'Year is required']"
                                    placeholder="Enter here"
                                />
                            </v-col>
                            <v-col cols="3" class="pb-0">
                                <v-text-field
                                    outlined
                                    dense
                                    v-model="student.phonenumber1"
                                    label="PhoneNumber1"
                                    :rules="[
                                        v => !!v || 'phonenumber is required'
                                    ]"
                                    placeholder="Enter here"
                                />
                            </v-col>
                            <v-col cols="3" class="pb-0">
                                <v-text-field
                                    outlined
                                    dense
                                    v-model="student.phonenumber2"
                                    label="PhoneNumber2"
                                    placeholder="Enter here"
                                />
                            </v-col>

                            <v-col cols="12" class="pb-0">
                                <v-textarea
                                    outlined
                                    dense
                                    v-model="student.Living_Location"
                                    label="Living_Location"
                                    :rules="[v => !!v || 'DOB is required']"
                                    placeholder="Enter here"
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
            student: {
                name: "",
                description: ""
            },
            sex: [
                { value: "M", text: "Male" },
                { value: "F", text: "Female" }
            ],
            shift: [
                { value: "M", text: "Morning" },
                { value: "A", text: "Afternoon" },
                { value: "E", text: "Evening" }
            ],
            items: [{ value: 1, text: "Morning" }]
            // {value: 'E', text: 'Evening'}['foo', 'bar', 'fizz', 'buzz']
            // items[
            // 	{value: 'items.id' , text:'items.name'}
            // ]
        };
    },
    methods: {
        onSubmit() {
            if (this.$refs.formCreate.validate()) {
                this.$chttp
                    .post("student/", this.student)
                    .then(res => {
                        this.$router.go(-1);
                    })
                    .catch(e => {});
            }
        },
        closeModal() {
            this.$router.go(-1);
        },
        getalldeparment() {
            this.$chttp.get("student/getalldepartment").then(res => {
                this.items = res.data.map(res => {
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
        this.getalldeparment();
    }
};
</script>
