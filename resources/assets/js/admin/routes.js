import VueRouter from 'vue-router';


let routes = [
    {
        path: '/categories-admin',
        component: require('./components/pages/Categories.vue').default,
        name: 'categoriesAdmin',
    },
    {
        path: '/tags-admin',
        component: require('./components/pages/Tags.vue').default,
        name: 'tagsAdmin',
    },
    {
        path: '/skills-admin',
        component: require('./components/pages/Skills.vue').default,
        name: 'skillsAdmin',
    },
    {
        path: '/blog-admin',
        component: require('./components/pages/Blog.vue').default,
        name: 'blogAdmin',
    },
    {
        path: '/news-admin',
        component: require('./components/pages/News.vue').default,
        name: 'newsAdmin',
    },
    {
        path: '/projects-admin',
        component: require('./components/pages/Projects.vue').default,
        name: 'projectsAdmin',
    },
    {
        path: '/about-admin',
        component: require('./components/pages/AboutMe.vue').default,
        name: 'aboutAdmin',
    },
    {
        path: '/social-admin',
        component: require('./components/pages/SocialLinks.vue').default,
        name: 'socialAdmin',
    },
    {
        path: '/users-admin',
        component: require('./components/pages/Users.vue').default,
        name: 'usersAdmin',
    },
    {
        path: '/contacts-admin',
        component: require('./components/pages/Contacts.vue').default,
        name: 'contactsAdmin',
    },
    {
        path: '/subscribed-admin',
        component: require('./components/pages/Subscribed.vue').default,
        name: 'subscribedAdmin',
    },

];

let router = new VueRouter ({
    routes,
    linkActiveClass: 'is-active'
});

export default router;