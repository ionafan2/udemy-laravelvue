import VueRouter from "vue-router";
import Bookables from "./bookables/Bookables";
import Bookable from "./bookable/Bookable";

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
            name: "bookable-show"
        },
    ]
});

export default router;
