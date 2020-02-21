import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../components/Pages/Home"
import Vendas from "../components/Pages/Vendas"



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
        {
            path: '/vendas',
            name: 'vendas',
            component: Vendas
        }
    ]
});
export default router;