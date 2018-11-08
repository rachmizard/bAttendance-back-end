
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

/*
Import Package
*/

import VCalendar from 'v-calendar';
import 'v-calendar/lib/v-calendar.min.css';
Vue.use(VCalendar, {
  firstDayOfWeek: 2,  // Monday
});

import alert from 'vue-strap/src/alert';
import VueGoogleCharts from 'vue-google-charts';
Vue.use(VueGoogleCharts);


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
Vue.component('karyawan-component', require('./components/karyawan/index.vue'));
Vue.component('create-karyawan', require('./components/karyawan/create.vue'));
Vue.component('create-jam', require('./components/jam/create.vue'));
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('history-page', require('./components/history/index.vue'), require('laravel-vue-pagination'));
Vue.component('approval-lembur-page', require('./components/lembur/index.vue'), require('laravel-vue-pagination'));
Vue.component('g-chart', require('./components/dashboard/GChartComponent.vue'));
Vue.component('create-absen', require('./components/absen/create.vue'));
Vue.component('table-absen', require('./components/absen/table.vue'));
Vue.component('datatable-absen', require('./components/absen/datatable.vue'));
Vue.component('rekap-absen', require('./components/master-rekap/index.vue'));
Vue.component('tgl-aktif-rekap', require('./components/master-rekap/tgl-aktif-rekap.vue'));
Vue.component('count-approval', require('./components/CountApprovalComponent.vue'))
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
},
{
  path: '/list_karyawan', name: 'lisKaryawan', component: require('./components/master-rekap/list-karyawan.vue'), props: { title: 'List Karyawan' }
},
{
  path: '/rekap_karyawan/:id', name: 'rekapKaryawan', component: require('./components/master-rekap/rekap-karyawan.vue')
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
          drawTable: true
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
