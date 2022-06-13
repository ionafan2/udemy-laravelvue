/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import VueRouter from "vue-router";
import Vue2Filters from 'vue2-filters';
import VueMoment from 'vue-moment';

import router from "./routes";

import Index from "./index";
import StarRating from "./shared/components/StarRating";

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

window.Vue.use(Vue2Filters)
// @see https://www.npmjs.com/package/vue2-filters

window.Vue.use(VueRouter);
window.Vue.use(VueMoment);
// @see https://github.com/brockpetrie/vue-moment
// @see https://momentjs.com/

//Globally registered
window.Vue.component('star-rating', StarRating);

const app = new window.Vue({
    el: '#app',
    router,
    components: {
        index: Index
    }
});
