import VueRouter from "vue-router";
import Bookables from "./bookables/Bookables";
import ExampleComponent from "./components/ExampleComponent";

const router = new VueRouter({
    mode:"history",
    routes: [
        {
            path: "/",
            component: Bookables,
            name: "home"
        },
        {
            path: "/con",
            component: ExampleComponent,
            name: "con"
        },
    ]
});

export default router;
