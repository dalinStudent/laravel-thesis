<template>
    <div>
        <TemplateA title="Create New User">
            <template #body>
                <v-form ref="formCreate" lazy-validation>
                    <v-container>
                        <v-row justify="space-around">
                        </v-row>
                        <v-row>
                            <v-col cols="4" class="pb-0">
                                <v-text-field
                                    outlined
                                    dense
                                    :error="errors.name.error"
                                    :messages="errors.name.message"
                                    	v-model="users.username"
                                    label="Username"
                                    :rules="[v => !!v || 'Name is required']"
                                    placeholder="Enter here"
                                />
                            </v-col>
                            <v-col cols="4" class="pb-0">
                                <v-text-field
                                    outlined
                                    dense
                                    :error="errors.name.error"
                                    v-model="users.password"
                                    :messages="errors.name.message"
                                    label="Password"
                                    :rules="[v => !!v || 'Name is required']"
                                    placeholder="Enter here"
                                />
                            </v-col>
                            <v-col cols="4" class="pb-0">
                                <!-- <v-text-field
                                    outlined
                                    dense
                                    :error="errors.name.error"
                                    v-model="users.employee_id"
                                    :messages="errors.name.message"
                                    label="Employee Name"
                                    :rules="[v => !!v || 'Employee Name is required']"
                                    placeholder="Employee Name"
                                /> -->
                                <v-autocomplete
                                    v-model="users.employee_id"
                                    :items="items"
                                    item-value="value"
                                    item-text="text"
                                    outlined
                                    dense
                                    label="Employee Name"
                                ></v-autocomplete>
                            </v-col>
                            <v-col cols="6" class="pb-0">
                                <v-select
                                    :items="role"
                                    outlined
                                     v-model="users.role"
                                    dense
                                    placeholder="Role"
                                    label="Role"
                                ></v-select>
                            </v-col>
                            <v-col cols="6" class="pb-0">
                                <v-select
                                    :items="status"
                                    outlined
                                    dense
                                       v-model="users.status"
                                    placeholder="Status"
                                    label="Status"
                                ></v-select>
                            </v-col>
                        </v-row>
                        
                    </v-container>
                </v-form>
                <v-row justify="end" class="mb-1 mr-1">
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
                        @click="submit()"
                    >
                        Save
                    </v-btn>
                </v-row>
            </template>
        </TemplateA>
    </div>
</template>
<script>
import InputFile from "../../../components/Input/File";
export default {
    components: {
        InputFile
    },
    data() {
        return {
            profilePreview: "",
            users: {
                username: '',
                password: '',
                role :'',
                employee_id : '',
                status: 'Active'
            },
            roles: [],
            errors: {
                name: { error: false, message: null },
                role: { error: false, message: null },
                phone_number: { error: false, message: null },
                sex: { error: false, message: null },
                description: { error: false, message: null },
                photo: { error: false, message: null },
                hour: { error: false, message: null }
            },
            status: [
                { value: "Active", text: "Active" },
                { value: "Inactive", text: "Inactive" }
            ],
            role: [
                { value: "Admin", text: "Admin" },
                { value: "Assistant", text: "Assistant" }
            ],
            items: [
				{value: 1, text: 'Morning'}
			],
        };
    },
    mounted() {
        this.init();
    },
    methods: {
        init() {
            this.$chttp.get("master/role").then(res => {
                console.log(res.data);
                this.roles = res.data.data.roles;
            });
        },
        closeModal() {
            this.$router.go(-1);
        },
        submit() {
            if (this.$refs.formCreate.validate()) {
                this.$chttp
                    .post("user/addFromWorker", this.users)
                    .then(res => {
                        this.closeModal();
                    })
                    .catch(e => {
                        if (e.response.status == 422) {
                            this.$refs.formCreate.resetValidation();
                            var keys = Object.keys(e.response.data.errors);
                            var sms = e.response.data.errors;
                            Object.keys(this.errors).forEach(el => {
                                if (keys.includes(el)) {
                                    this.errors[el] = {
                                        error: true,
                                        message: sms[el][0]
                                    };
                                } else {
                                    this.errors[el] = {
                                        error: false,
                                        message: ""
                                    };
                                }
                            });
                        }
                    });
            }
        },
         getallemployee() {
            this.$chttp.get("user/getallemployee").then(res => {
                this.items = res.data.map(res => {
                    return {
                        text: res.name,
                        value: res.id
                    };
                });
                // console.log(res);
            });
        },
        
    },
    created() {
        this.getallemployee();

    }
};
</script>
