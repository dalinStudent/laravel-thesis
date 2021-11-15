import Vue from 'vue';
import Vuex from 'vuex';
import VueCookies from 'vue-cookies'

Vue.use(VueCookies)
Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';

export default new Vuex.Store({
    state: {
        isLoading: false,
        isOpenDrawer: true,
        isShowNavBar: true,
        user: {
            name: 'vuthea'
        }
    },
    mutations: {
        setLoading(state, isLoading) {
            state.isLoading = isLoading;
        },
        setUser(state, user) {
            state.user = user
            if (user) {
                Vue.$cookies.set('user', JSON.stringify(user), user.expire_duration+'s');
            } else {
                Vue.$cookies.remove('user');
            }
        },
        setDrawerState(state, val) {
            state.isOpenDrawer = val
        },
        setNavBarState(state, val) {
            state.isShowNavBar = val
        }
    },
    getters: {
        getLoading: (state) => {
            return state.isLoading;
        },
        getUser: (state) => {
            return state.user
        }
    },
    modules: {

    },
    strict: debug,
});
