import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)
import store from '@/store'

import app from '@/components/layouts/app'
import auth from '@/components/layouts/auth'


// Authenticated Components
import home from '@/components/pages/app/home'





/**
* Web Routes
*
*/
let web_routes = [

	{ path: '/', name: 'app', component: app, meta: { auth: false },  },


	/**
	* Public Routes
	* @type {String}
	*/
	{
		path: '/login', name: 'login', component: auth,
		meta: {
			auth: false
		},
	},


	/**
	* Authenticated Routes
	* @type {Router}
	*/
	{
		path: '/app/home', name: 'home', component: home,
		meta: {
			auth: true
		},
	},

];


let router = new Router({
	routes: web_routes,
	mode: 'history'
});


router.beforeEach((to, from, next) => {

	if (to.matched.some(web_routes => web_routes.meta.auth)) {

		if (router.app.$session.exists()) {
			next()
			console.log('Authenticated')
		}
		else {
			console.log('Unauthenticated')
			window.location.href = router.app.$store.state.app_url

		}
	}
});



export default router
