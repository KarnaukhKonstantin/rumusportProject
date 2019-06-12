import Vue from 'vue'
import VueRouter from 'vue-router';
import Vuelidate from 'vuelidate';
import VueSwal from 'vue-swal';
import VueScrollReveal from 'vue-scroll-reveal';
import router from './routes';
// import 'es6-promise/auto';


window.Vue = Vue;
window.Bus = new Vue;

Vue.use(VueRouter);
Vue.use(Vuelidate);
Vue.use(VueSwal);
Vue.use(VueScrollReveal, {
 	class: 'v-scroll-reveal',
 	duration: 1000,
 	scale: 1,
 	distance: '40px',
 	mobile: false,
 	rotate: {
        x: 0,
        y: 0,
        z: 0
     },
 });
require('./bootstrap');



// Register
Vue.component('login-modal', require('./components/modals/Login.vue').default);
Vue.component('register-modal', require('./components/modals/Register.vue').default);

//Layouts
Vue.component('platform-header', require('./components/layouts/Header.vue').default);
Vue.component('platform-header-left', require('./components/layouts/HeaderLeft.vue').default);
Vue.component('platform-footer', require('./components/layouts/Footer.vue').default);
Vue.component('categories-list', require('./components/layouts/Categories.vue').default);
Vue.component('article-post', require('./components/layouts/Article.vue').default);





const app = new Vue({
	el: '#app',
	router,

created() {
	
}
});
