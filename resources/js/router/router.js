import Vue from "vue";
import VueRouter from "vue-router";
import routes from './routes'
import store from '../store'

Vue.use(VueRouter);
const router = new VueRouter({
    mode: "history",
    routes,
});
router.beforeEach((to, from, next) => {
    if (to.meta.guest && store.state.user.isLoggedIn) {
        next({name: 'home'})
    } else {
        next()
    }
    if (to.meta.auth && !store.state.user.isLoggedIn) {
        next({name: 'home'})
    } else {
        next()
    }
    //For Only Manager and Authenticated and LoggedIn User Can Access to Specific Routes
    if (to.meta.auth && store.state.user.isLoggedIn && !to.meta.canSeeUser) {
        if (store.state.user.user.role !== '1') {
            next({name: 'home'})
        }


    } else {
        next()
    }


    if (to.meta.auth) {
        if (store.state.user.user.authType === 'mobile' && store.state.user.user.isMobileVerified !== 2) {
            next({name: 'home'})
        }
        if (store.state.user.user.authType === 'email' && store.state.user.user.isVerified !== 2) {
            next({name: 'home'})
        }
    } else {
        next()
    }

})
export default router;
