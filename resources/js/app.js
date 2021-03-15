/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

//this is for convert countries
var isoCountries = require("i18n-iso-countries");
isoCountries.registerLocale(require("i18n-iso-countries/langs/en.json"));

window.isoCountries = isoCountries


// Dependency importations
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueToast from 'vue-toast-notification';
import vueCountryRegionSelect from 'vue-country-region-select'

// CSS Importations
import 'vue-toast-notification/dist/theme-sugar.css';


// Middlewares
Vue.use(VueRouter);
Vue.use(VueToast, {
    position: 'top-right'
});
Vue.use(vueCountryRegionSelect)

import App from './App.vue';
import routes from './routes';

const router = new VueRouter({
    mode: 'history',
    routes,
});


const isAuth = document.head.querySelector('meta[name="isAuth"]').getAttribute('content');


window.isAuthenticated = () => {
    return isAuth;
}


router.beforeEach((to, from, next) => {



    if (to.matched.some(record => record.meta.requireAuth)) {
        if (!isAuth) {
            next({ name: 'login' })
        } else {
            next()
        }
    } else {
        next();
    }


    if (to.matched.some(record => record.meta.requireGuest)) {
        if (window.isAuthenticated()) {
            router.go(-1)
        }
    }

});


Vue.component('csrf-field', {
    template: `
        <input type="hidden" name="_token" :value="csrf_token">
    `,
    computed: {
        csrf_token() {
            return window.csrfContent;
        }
    }
});
  
Vue.component('pagination', require('laravel-vue-pagination'));

const app = new Vue({
    el: '#app',
    router,
    components: { App },
});

//importing moment js

var moment = require('moment');

window.moment=moment;

