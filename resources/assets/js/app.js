
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/*
  Import Jquery
*/

window.$ = require('jquery');
window.JQuery = require('jquery');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('loading', require('./components/LoadingComponent.vue'));
Vue.component('history-component', require('./components/HistoryComponent.vue'));
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
  path: '/',  name: 'index',component: require('./components/DashboardComponent.vue'), props: { title: 'Dashboard'}
},
{
  path: '/karyawan',  name: 'userIndex',component: require('./components/karyawan/index.vue'), props: { title: 'Master Karyawan' }
},
{
  path: '/create', name: 'userCreate', component: require('./components/karyawan/create.vue'), props: { title: 'Tambah Karyawan' } 
},
{
  path: '/edit', name: 'userEdit', component: require('./components/karyawan/edit.vue'), props: { title: 'Edit Karyawan' }
},
{
  path: '/history', name: 'historyIndex', component: require('./components/history/index.vue'), props: { title: 'History Absensi' }
}
]
const router = new VueRouter({
 routes 
});

const app = new Vue({
	data: { loading: false },
	router
}).$mount('#app');

router.beforeEach((to, from, next) => {
  app.loading = true
	next()
})

router.afterEach((to, from, next) => {
  setTimeout(() => app.loading = false, 1500) // timeout for demo purposes
})
