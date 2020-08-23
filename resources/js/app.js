/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
// import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('navbar', require('./components/Navbar.vue').default);
Vue.component('vfooter', require('./components/Vfooter.vue').default);
Vue.component('feed', require('./components/Feed.vue').default);
Vue.component('comments', require('./components/Comments.vue').default);

var sessionUser = JSON.parse(document.querySelector("meta[name='session_user']").getAttribute('content'));
var liked = JSON.parse(sessionUser.liked);
var notification_preferences = JSON.parse(sessionUser.notification_preferences);
var favorites = JSON.parse(sessionUser.favorites);
var followed = JSON.parse(sessionUser.followed);
var followers = JSON.parse(sessionUser.followers);
sessionUser.liked = liked;
sessionUser.notification_preferences = notification_preferences;
sessionUser.favorites = favorites;
sessionUser.followed = followed;
sessionUser.followers = followers;

Vue.prototype.$sessionUser = sessionUser

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// import axios from 'axios'
window.axios = require('axios');

const app = new Vue({
    el: '#app',
    data() {
        return {
            
        }
    },
   
    
    components: {

    },

    

   
});

