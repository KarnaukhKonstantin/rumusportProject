import VueRouter from 'vue-router';

let routes = [
	{
		path: '/',
		component: require('./components/pages/Main.vue').default,
		name: 'home',
	},
	{
		path: '/projects',
		component: require('./components/pages/Projects.vue').default,
		name: 'platform-projects',
	},
	{
		path: '/blog',
		component: require('./components/pages/Blog.vue').default,
		name: 'platform-blog',
	},
	{
		path: '/post/:id',
		component: require('./components/pages/Post.vue').default,
		name: 'post'
	},
	{
		path: '/category/:id',
		component: require('./components/pages/Category.vue').default,
		name: 'category'
	},
	{
		path: '/about',
		component: require('./components/pages/About.vue').default,
		name: 'platform-about',
	},
	{
		path: '/other',
		component: require('./components/pages/Other.vue').default,
		name: 'platform-other',
	},
	{
		path: '/expirience',
		component: require('./components/pages/Expirience.vue').default,
		name: 'platform-expirience',
	},
	{
		path: '/skills',
		component: require('./components/pages/Skills.vue').default,
		name: 'platform-skills',
	},
	{
		path: '/skill/:id',
		component: require('./components/pages/Skill.vue').default,
		name: 'skill'
	},
	{
		path: '/stack',
		component: require('./components/pages/Stack.vue').default,
		name: 'platform-stack',
	},
	{
		path: '/links',
		component: require('./components/pages/Links.vue').default,
		name: 'platform-links',
	},

	 // {
  //       path: '/signin',
  //       name: 'signin',
  //       component: require('./components/contents/signin/TheSignin')
  //       //component: require('./views/Futures')
  //   },
  //   {
  //       path: '/login',
  //       name: 'login',
  //       //component: require('./views/Menu')
  //   }
	
];



let router = new VueRouter ({
	routes,
	// mode: 'history',
	linkActiveClass: 'is-active'
});




export default router;