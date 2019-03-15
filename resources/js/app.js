
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Buefy from 'buefy';
import 'buefy/dist/buefy.css';
import Datepicker from 'buefy/dist/components/datepicker';
import Vue from 'vue'
import VueRouter from 'vue-router'



Vue.use(VueRouter)
Vue.use(Buefy);
Vue.use(Datepicker);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('login', require('./components/login.vue').default);
Vue.component('dashboard', require('./components/dashboard.vue').default);
Vue.component('manageusers', require('./manage/users/UsersComponent.vue').default);
Vue.component('singleuser', require('./manage/users/showComponent.vue').default);
Vue.component('usercreate', require('./manage/users/UserCreate.vue').default);
Vue.component('settings', require('./manage/settings/settings.vue').default);
Vue.component('vendors', require('./vendors/Vendors.vue').default);
Vue.component('autosnew', require('./products/AutosNewProduct.vue').default);
Vue.component('productedit', require('./products/AutosEditProduct.vue').default);
Vue.component('autosprotucts', require('./products/AutosProducts.vue').default);
Vue.component('showautos', require('./products/AutosShow.vue').default);
Vue.component('electronic-products', require('./products/ElectronicProducts.vue').default);
//Vue.component('showelectronic', require('./products/ElectronicShow.vue').default);



import showelectronic from './products/ElectronicShow.vue';
// router
const router = new VueRouter({
    mode: 'history',
    routes: [
        // {
        //     path: '/',
        //     name: 'home',
        //     component: Home
        // },
        {
            path: '/products./electronic/showelectronic',
            name: 'showelectronic',
            component: showelectronic,
        },
    ],
});




const app = new Vue({
    el: '#app',
    router
});


// Bulma NavBar Burger Script
document.addEventListener('DOMContentLoaded', function () {
    // Get all "navbar-burger" elements
    const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
    
    // Check if there are any navbar burgers
    if ($navbarBurgers.length > 0) {
        
        // Add a click event on each of them
        $navbarBurgers.forEach(function ($el) {
            $el.addEventListener('click', function () {
                
                // Get the target from the "data-target" attribute
                let target = $el.dataset.target;
                let $target = document.getElementById(target);
                
                // Toggle the class on both the "navbar-burger" and the "navbar-menu"
                $el.classList.toggle('is-active');
                $target.classList.toggle('is-active');
                
            });
        });
    }
    
});



require('./bulma-extensions');