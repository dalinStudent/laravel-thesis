<template>
    <v-app>
        <v-app-bar app dense flat class="v-app-bar" v-if="isShowNavBar">
            <v-app-bar-nav-icon
                @click="toggleDrawer()"
                color="red"
            ></v-app-bar-nav-icon>
            <v-row align="center" id="button" justify="space-around">
                <v-btn depressed @click="changelanguage()">
                    ENG
                </v-btn>
            </v-row>
        </v-app-bar>

        <v-navigation-drawer app floating :value="isDrawerOpen">
            <div class="drawer">
                <Profile />
                <slot name="drawer" />
                <Logout />
            </div>
        </v-navigation-drawer>

        <v-main>
            <v-container fluid>
                <router-view></router-view>
                <Loader />
            </v-container>
        </v-main>
    </v-app>
</template>
<script>
import Profile from "./Drawer/Profile";
import Logout from "./Drawer/Logout";
import Loader from "./Modal/Loader";
export default {
    components: {
        Loader,
        Logout,
        Profile
    },
    computed: {
        isDrawerOpen() {
            return this.$store.state.isOpenDrawer;
        },
        isShowNavBar() {
            return this.$store.state.isShowNavBar;
        }
    },
    data() {
        return {
            drawer: true
        };
    },
    methods: {
        toggleDrawer() {
            this.$store.commit(
                "setDrawerState",
                !this.$store.state.isOpenDrawer
            );
        },
        changelanguage(){
            // console.log(this.$cookies.get("lang"));
            if(this.$cookies.get("lang") == "kh"){
            this.$cookies.set("lang","en");
            
            }
            else{
                this.$cookies.set("lang","kh");
            }
           window.location.reload(true);
        }
    }
};
</script>
