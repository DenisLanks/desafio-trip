/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
var bootstrap = require("bootstrap-vue");
import VueRouter from "vue-router";
import vuex from "vuex";
Vue.use(bootstrap.BootstrapVue);
Vue.use(bootstrap.IconsPlugin);
Vue.use(VueRouter);
Vue.use(vuex);

Vue.filter('toCurrency', function (value) {
    if (typeof value !== "number") {
        return value;
    }
    var formatter = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 0
    });
    return formatter.format(value);
});

const store = new vuex.Store({
    state: {
      user:{}
    },
    mutations: {
        changeUser(state, user){
            state.user = user;
            console.log(user);
        }
    }
  })
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

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import LoginPage from "../js/pages/LoginPage";
import RegisterPage from "../js/pages/RegisterPage";
import TripPage from "../js/pages/TripPage";
const routes = [
  { path: '/signup', component: RegisterPage },
  { path: '/signin', component: LoginPage,  },
  { path: '/home', component: TripPage }
];
const router = new VueRouter({
    routes // short for `routes: routes`
});
const app = new Vue({
    el: '#app',
    router,
    store
});
