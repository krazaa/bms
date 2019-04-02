
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
import moment from 'moment';

import VueRouter from 'vue-router'
import ourRoutes from './routes.js'
import VeeValidate from 'vee-validate';

Vue.filter('formatDate', function(value) {

  if (value) {
    return moment(String(value)).format('MM/DD/YYYY')
  }

});


Vue.use(VueRouter)
Vue.use(Buefy);
Vue.use(Datepicker);
Vue.use(VeeValidate);


//
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/ExampleComponent.vue').default);
 Vue.component('login', require('./components/login.vue').default);
 Vue.component('autocomplet', require('./components/autocomplet.vue').default);
// Vue.component('dashboard', require('./components/dashboard.vue').default);
// Vue.component('manageusers', require('./manage/users/UsersComponent.vue').default);
// Vue.component('singleuser', require('./manage/users/showComponent.vue').default);
// Vue.component('usercreate', require('./manage/users/UserCreate.vue').default);
// Vue.component('settings', require('./manage/settings/settings.vue').default);
// Vue.component('vendors', require('./vendors/Vendors.vue').default);
// Vue.component('vendorssr', require('./vendors/VendorSSR.vue').default);
// Vue.component('vendorcreate', require('./vendors/VendorCreate.vue').default);
// Vue.component('autosnew', require('./products/AutosNewProduct.vue').default);
// Vue.component('productedit', require('./products/AutosEditProduct.vue').default);
// Vue.component('autosprotucts', require('./products/AutosProducts.vue').default);
// Vue.component('showautos', require('./products/AutosShow.vue').default);
// Vue.component('electronic-products', require('./products/ElectronicProducts.vue').default);
// Vue.component('branches', require('./manage/branches/branches.vue').default);
// Vue.component('newbranch', require('./manage/branches/AddBranch.vue').default);
// Vue.component('editbranch', require('./manage/branches/EditBranch.vue').default);
Vue.component('pagination', require('laravel-vue-bulma-paginator'));

// import Autocomplete from './components/autocomplet'
//Vue.component('showelectronic', require('./products/ElectronicShow.vue').default);

Vue.use(VueRouter);

// const router = new VueRouter({
//   routes: ourRoutes,

// });
const token = localStorage.getItem('user-token')
if (token) {
  axios.defaults.headers.common['Authorization'] = token
}

// router
const router = new VueRouter({
  routes: ourRoutes,
  mode: 'history'

});

////

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    // this route requires auth, check if logged in
    // if not, redirect to login page.
    if (!auth.loggedIn()) {
      next({
        path: '/agents',
        query: { redirect: to.fullPath }
      })
    } else {
      next()
    }
  } else {
    next() // make sure to always call next()!
  }
})
////




export default router

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
