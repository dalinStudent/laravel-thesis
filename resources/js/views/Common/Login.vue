<template>
    <v-app class="card-container">
        <v-main class="card-container">
            <v-container fluid>
                <div class="card-container">
                    <!-- <img src="images/logo.jpg" alt="" class="img-background"> -->
                    <v-card class="my-card" width="700" color="white">
                        <v-row class="mr-0 ml-0 mt-0 mb-0">
                            <v-col cols="4" class="logo-container">
                                <img src="images/NORTON.png" alt="" class="logo" />
                            </v-col>
                            <v-col cols="8" class="form-container">
                                <div class="form-header">Login</div>
                                <v-divider class="mt-0" />
                                <v-form class="form-body" ref="formLogin" lazy-validation>
                                    <v-col md="4"></v-col>
                                    <v-row>
                                        <v-col cols="3" class="pt-4">
                                            <h5><b>Username</b></h5>
                                        </v-col>
                                        <v-col cols="8">
                                            <v-text-field 
                                                v-model="form.username"
                                                :error="errors.username.error"
                                                :messages="errors.username.message"
                                                outlined 
                                                :rules="[ v => !!v || 'Username is required']"
                                                dense
                                            />
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col cols="3" class="pt-4">
                                            <h5><b>Password</b></h5>
                                        </v-col>
                                        <v-col cols="8">
                                            <v-text-field
                                                v-model="form.password"
                                                outlined 
                                                type="password"
                                                :error="errors.password.error"
                                                :messages="errors.password.message"
                                                :rules="[ v => !!v || 'Password is required']"
                                                dense
                                            />
                                        </v-col>
                                    </v-row>
                                    <!-- <v-col md="4"></v-col> -->
                                    <v-col cols="12">
                                        <!-- <v-btn width="inherit" color="error" dark large @click="onLoginClick()">
                                            Sign Up
                                        </v-btn> -->
                                        <v-btn width="inherit" color="error" dark large @click="onLoginClick()">
                                            Login
                                        </v-btn>
                                    </v-col>
                                </v-form>
                            </v-col>
                        </v-row>
                    </v-card>
                    <Loader/>
                </div>
            </v-container>
        </v-main>
    </v-app>
</template>
<script>
import Loader from '../../components/Modal/Loader'
import Auth from '../../http/auth'
export default {
    components:{
        Loader
    },
    data() {
        return {
            form: {
                username: "Admin",
                password: "beniten@007"
            },
            errors: {
                username: {error: false, message: null},
                password: {error: false, message: null},
            }
        }
    },
    methods: {
        onLoginClick() {
            if (this.$refs.formLogin.validate()) {
                Auth.login(this.form)
            }
        }
    },
};
</script>