import VueRouter from 'vue-router';

let routes = [
	{
		path: '/',
		component: require('./components/pages/Main.vue').default,
		name: 'home',
	},
	 {
        path: '/signin',
        name: 'signin',
        component: require('./components/contents/signin/TheSignin')
        //component: require('./views/Futures')
    },
    {
        path: '/login',
        name: 'login',
        //component: require('./views/Menu')
    }
	
];



let router = new VueRouter ({
	routes,
	// mode: 'history',
	linkActiveClass: 'is-active'
});




export default router;