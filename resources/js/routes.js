import VueRouter from "vue-router";

const router = new VueRouter({
    mode:"history",
    routes: [
        {
            path: "/",
            component: require('./components/ExampleComponent.vue').default,
            name: "home"
        },
        {
            path: "/con",
            component: require('./components/ExampleComponentSecond.vue').default,
            name: "home"
        },
    ]
});

export default router;
