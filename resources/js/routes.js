import VueRouter from "vue-router";

const router = new VueRouter({
    routes: [
        {
            path: "/",
            component: require('./components/ExampleComponent.vue').default,
            name: "home"
        }
    ]
});

export default router;
