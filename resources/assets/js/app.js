
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
Vue.component('alert-box', require('./components/AlertComponent.vue'), { props: ['title', 'message', 'type'] });
Vue.component('create-karyawan', require('./components/karyawan/create.vue'));
Vue.component('create-jam', require('./components/jam/create.vue'));


/*
Import Package
*/

import alert from 'vue-strap/src/alert';
// Vue.use(alert);

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
  components: {
    alert: alert
  },

	data: { 
          loading: false,
          expired: false,
          title: '',
          message: '',
          type: '',
          image: '',
  },

	router
}).$mount('#app');

/*
  *
  *
  It'll be sent broadcast alert
  *
  *
*/
Echo.channel('expired-session')
.listen('ExpiredSession', (e) => {
  app.expired = true
  setTimeout(() => app.expired = false, 10000)
  app.title = e.title
  app.message = e.message
  app.type = e.type // get danger alert (danger is using bootstrap css)
});

/*
  *
  *
  It'll be sent absen broadcast alert to admin
  *
  *
*/


Echo.channel('absen')
.listen('Absen', (e) => {
  app.expired = true // triger for launch an alert!
  setTimeout(() => app.expired = false, 10000)
  app.title = e.title
  app.message = e.message
  app.type = e.type // get danger alert (danger is using bootstrap css)
  app.image = e.image // get image from listener broadcast
});

router.beforeEach((to, from, next) => {
  app.loading = true
	next()
})

router.afterEach((to, from, next) => {
  setTimeout(() => app.loading = false, 1500) // timeout for demo purposes
})
