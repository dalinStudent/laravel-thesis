<template>
    <div>
        <TemplateA title="Update Category">
            <template #body>
                <v-form ref="formEdit" lazy-validation>
                    <v-container>
                        <v-row justify="space-around"> </v-row>
                        <v-row>
                            <v-col cols="6">
                                <v-text-field
                                    outlined
                                    dense
                                    v-model="category.name"
                                    label="Category Name"
                                    :rules="[
                                        v => !!v || 'Category Name is required'
                                    ]"
                                    placeholder="Enter here"
                                />
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="6">
                                <v-text-field
                                    outlined
                                    dense
                                    v-model="category.description"
                                    label="Description"
                                    :rules="[
                                        v =>
                                            !!v ||
                                            'Description Name is required'
                                    ]"
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
            category: {
                name: "",
                description: ""
            }
        };
    },
    methods: {
        onSubmit() {
            if (this.$refs.formEdit.validate()) {
                this.$chttp
                    .put(`category/${this.$route.params.id}`, this.category)
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
            this.$chttp.get("category/" + this.$route.params.id).then(res => {
                this.category = res.data[0];
                //  console.log(res.data)
            });
        }
        
        
    },
    created() {
            this.init();
            // this.getallcategory();
        }
};
</script>
