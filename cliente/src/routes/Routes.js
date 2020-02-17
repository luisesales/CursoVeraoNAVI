import Vue from "vue";
import VueRouter from "vue-router";
import Home from "./../components/Pages/Home"
//import Home from "./../components/Pages/Home"


Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    history: true,
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },

        /*{
            path: '/veiculos',
            name: 'veiculos',
            component: Veiculos
        }*/
    ]
});
export default router;