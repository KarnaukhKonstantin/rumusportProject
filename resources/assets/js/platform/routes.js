import VueRouter from 'vue-router';

let routes = [
	{
		path: '/',
		component: require('./components/pages/Main.vue').default,
		name: 'home',
	},
	
];



let router = new VueRouter ({
	routes,
	// mode: 'history',
	// linkActiveClass: 'active'
});




export default router;