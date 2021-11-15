<template>
    <div>
        <TemplateA title="User Profile">
            <template #body>
                <v-form ref="formCreate" lazy-validation>
                    <v-container>
                        <v-row justify="space-around"> </v-row>
                        <v-row>
                            <v-col cols="4" class="pb-0">
                                <v-text-field
                                    outlined
                                    dense
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
                                    label="IDCard"
                                    :rules="[v => !!v || 'IDCard is required']"
                                    placeholder="Enter here"
                                />
                            </v-col>
                            <v-col cols="2" class="pb-0">
                                <v-select
                                    :items="sex"
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
                                    label="DOB"
                                    type="date"
                                    form
                                    :rules="[v => !!v || 'DOB is required']"
                                    placeholder="Enter here"
                                />
                            </v-col>
                        </v-row>
                    </v-container>
                </v-form>
            </template>
        </TemplateA>
    </div>
    </template>
    <script>
        export default {
            data() {
                return {};
            },
            mounted() {
                this.init();
            },
            methods: {
                init() {
                    this.$chttp.get("user/profile").then(res => {
                        console.log(res);
                    });
                }
            }
        };
    </script>
       
