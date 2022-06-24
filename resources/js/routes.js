import VueRouter from "vue-router";
import Bookables from "./bookables/Bookables";
import Bookable from "./bookable/Bookable";
import Review from "./review/Review";
import Basket from "./basket/Basket";

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
        }
    ]
});

export default router;
