/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from "vue";

window.Vue = Vue;

import VueRouter from "vue-router";
import Vuex from 'vuex'
import Vue2Filters from 'vue2-filters';
import VueMoment from 'vue-moment';

import Index from "./index";
import Router from "./routes";
import StoreDefinition from "./store";

import StarRating from "./shared/components/StarRating";
import FatalError from "./shared/components/FatalError";
import ValidationErrors from "./shared/components/ValidationErrors";
import Success from "./shared/components/Success";

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.use(VueRouter);
Vue.use(Vuex);

Vue.use(Vue2Filters)
// @see https://www.npmjs.com/package/vue2-filters

Vue.use(VueMoment);
// @see https://github.com/brockpetrie/vue-moment
// @see https://momentjs.com/

//Globally registered
Vue.component('star-rating', StarRating);
Vue.component("fatal-error", FatalError);
Vue.component("v-errors", ValidationErrors);
Vue.component("success", Success);

Vue.prototype.$log = console.log;

const store = new Vuex.Store(StoreDefinition);

const app = new window.Vue({
    el: '#app',
    store,
    router: Router,
    components: {
        index: Index
    }
});
