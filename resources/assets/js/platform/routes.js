import VueRouter from 'vue-router';

let routes = [
	{
		path: '/',
		component: require('./components/pages/About.vue').default,
		name: 'home',
	},
	
];



let router = new VueRouter ({
	routes,
	// mode: 'history',
	// linkActiveClass: 'active'
});




export default router;