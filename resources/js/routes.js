import VueRouter from "vue-router";
import Bookables from "./bookables/Bookables";
import Bookable from "./bookable/Bookable";
import Review from "./review/Review";
import Basket from "./basket/Basket";
import Login from "./auth/Login";

const router = new VueRouter({
    mode:"history",
    routes: [
        {
            path: "/",
            component: Bookables,
            name: "home"
        },
        {
            path: "/bookables/:id",
            component: Bookable,
            name: "bookable"
        },
        {
            path: "/reviews/:id",
            component:  Review,
            name: "review"
        },
        {
            path: "/basket",
            component: Basket,
            name: "basket"
        },
        {
            path: "/auth/login",
            component: Login,
            name: "login"
        },
    ]
});

export default router;
