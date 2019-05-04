import Vue from 'vue'
import VueRouter from 'vue-router';
import Vuelidate from 'vuelidate';
import VueSwal from 'vue-swal';

import router from './routes';

window.Vue = Vue;
window.Bus = new Vue;

Vue.use(VueRouter);
Vue.use(Vuelidate);
Vue.use(VueSwal);

require('./bootstrap');

// Layouts admin
Vue.component('admin-header', require('./components/layouts/Header.vue').default);
Vue.component('admin-sidebar', require('./components/layouts/Sidebar.vue').default);

const app = new Vue({
	el: '#app',
	router,
	 
});
