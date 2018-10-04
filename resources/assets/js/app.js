
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
// Vue.component('dashboard-component', require('./components/DashboardComponent.vue'));

/**
* Vue Router
*
* @link http://router.vuejs.org/en/installation.html
*/
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// define routes for karyawans
const routes = [
{
  path: '/',  name: 'index',component: require('./components/DashboardComponent.vue')
},
{
  path: '/karyawan',  name: 'userIndex',component: require('./components/karyawan/index.vue')
},
{
  path: '/create', name: 'userCreate', component: require('./components/karyawan/create.vue') 
},
{
  path: '/edit', name: 'userEdit', component: require('./components/karyawan/edit.vue') 
}
]
const router = new VueRouter({ routes });

const app = new Vue({
	router
}).$mount('#app');
