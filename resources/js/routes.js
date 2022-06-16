import VueRouter from "vue-router";
import Bookables from "./bookables/Bookables";
import Bookable from "./bookable/Bookable";
import Review from "./review/Review";

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
        },,
        {
            path: "/review/:id",
            component:  Review,
            name: "review"
        },
    ]
});

export default router;
