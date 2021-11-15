import Vue from 'vue';
import VueRouter from 'vue-router';
import LoginPage from '@Common/Login'
import AdminRoute from './admin'
// import SideManagerRoute from './side_manager'
import AssistantRoute from './assistant'
// import ErrorPage from '@Common/Error/Index'

Vue.use(VueRouter);

const routes = [
    {
        path: '/login',
        name: 'login',
        component: LoginPage
    },
    {
        path: '/',
        name: '',
        redirect: '/login'
    },
    // {
    //     path: '*',
    //     component: ErrorPage
    // },
    AdminRoute,
    // SideManagerRoute,
    AssistantRoute
];

const router = new VueRouter({
    routes: routes
});

router.routeTo = async function(to) {
    var except = ['login', '']
    if (!except.includes(to.name)) {
        var user = await Vue.$cookies.get('user');
        to.name = user.user.role +'.'+ to.name
        router.push(to)
    }
}

router.beforeEach( async (to, from, next) => {
    var user = await Vue.$cookies.get('user');
    if (user == null) {
        if (to.name === 'login') {
            return next()
        } else {
            return next({ name: 'login' })
        }
    } else if (user !== null){
        if (to.name == 'login') {
            if (user.user.role === 'admin') {
                return next({
                    name:`${user.user.role}.home`
                })
            }
            return next({
                name:`${user.user.role}.project`
            })
        } else {
            var base_url = to.fullPath.split('/')[1]
            if (base_url == user.user.role) {
                return next()
            } else if (base_url[1] !== user.user.role) {
                return next({
                    name:`${user.user.role}.project`
                })
            }
        }
    }
})

export default router;