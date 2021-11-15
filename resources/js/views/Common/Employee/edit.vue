<template>
    <div>
        <TemplateA title="Edit Employee">
            <template #body>
                <v-form ref="formEdit" lazy-validation>
                    <v-container>
                        <v-row justify="space-around"> </v-row>
                        <v-row>
                            <v-col cols="4" class="pb-0">
                                <v-text-field
                                    outlined
                                    dense
                                    v-model="employee.name"
                                    label="Employee Name"
                                    :rules="[
                                        v => !!v || 'Employee Name is required'
                                    ]"
                                    placeholder="Enter here"
                                />
                            </v-col>

                            <v-col cols="2" class="pb-0">
                                <v-select
                                    :items="sex"
                                    v-model="employee.gender"
                                    outlined
                                    dense
                                    :rules="[v => !!v || 'Sex is required']"
                                    label="Sex"
                                ></v-select>
                            </v-col>

                            <v-col cols="3" class="pb-0">
                                <v-text-field
                                    outlined
                                    dense
                                    v-model="employee.phone_number"
                                    label="Phone Number"
                                    placeholder="Enter here"
                                />
                            </v-col>
                            <v-col cols="3" class="pb-0">
                                <v-autocomplete
                                    v-model="employee.role_id"
                                    :items="items"
                                    item-value="value"
                                    item-text="text"
                                    outlined
                                    dense
                                    label="Role"
                                ></v-autocomplete>
                            </v-col>
                            <v-col cols="12" class="pb-0">
                                <v-text-field
                                    outlined
                                    dense
                                    v-model="employee.description"
                                    label="Description"
                                    placeholder="Enter here"
                                />
                            </v-col>
                        </v-row>
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
            employee: {
                name: "",
                role_id: ""
            },
            sex: [
                { value: "M", text: "Male" },
                { value: "F", text: "Female" }
            ],
            items: [{ value: 1, text: "Morning" }]
        };
    },
    methods: {
        onSubmit() {
            if (this.$refs.formEdit.validate()) {
                this.$chttp
                    .put(`employee/${this.$route.params.id}`, this.employee)
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
                .get("employee" + "/" + this.$route.params.id)
                .then(res => {
                    this.employee = res.data;
                    //  console.log(res.data)
                });
        },
        getallrole() {
            this.$chttp.get("employee/getallrole").then(res => {
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
        this.init();
        this.getallrole();
    }
};
</script>
