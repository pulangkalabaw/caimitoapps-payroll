import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)
import store from '@/store'

import app from '@/components/layouts/app'
import auth from '@/components/layouts/auth'


// Authenticated Components
import home from '@/components/pages/app/home'
import hello from '@/components/HelloWorld'

// Employee
import employeesIndex from '@/components/pages/app/employees/index'
import employeesCreate from '@/components/pages/app/employees/create'
import employeesShow from '@/components/pages/app/employees/show'
import employeesEdit from '@/components/pages/app/employees/edit'

// Department
import departmentIndex from '@/components/pages/app/department/index'
import departmentCreate from '@/components/pages/app/department/create'
import departmentShow from '@/components/pages/app/department/show'

// Jobs
import jobsIndex from '@/components/pages/app/jobs/index'
import jobsCreate from '@/components/pages/app/jobs/create'
import jobsShow from '@/components/pages/app/jobs/show'

// Compensation
import compensationIndex from '@/components/pages/app/compensation/index'
import compensationCreate from '@/components/pages/app/compensation/create'
import compensationShow from '@/components/pages/app/compensation/show'
import compensationAssign from '@/components/pages/app/compensation/assign'

// Deductions
import deductionIndex from '@/components/pages/app/deduction/index'
import deductionCreate from '@/components/pages/app/deduction/create'
import deductionShow from '@/components/pages/app/deduction/show'
import deductionAssign from '@/components/pages/app/deduction/assign'

// Leaves
import leavesIndex from '@/components/pages/app/leaves/index'
import leavesCreate from '@/components/pages/app/leaves/create'
import leavesShow from '@/components/pages/app/leaves/show'

// Leave Credit
import leaveCreditIndex from '@/components/pages/app/leavecredits/index'
import leaveCreditAssign from '@/components/pages/app/leavecredits/assign'

// Sss Management
import sssgovtIndex from '@/components/pages/app/government/sss/index'
import sssgovtCreate from '@/components/pages/app/government/sss/create'

// Tax Management
import taxgovtIndex from '@/components/pages/app/government/tax/index'
import taxgovtCreate from '@/components/pages/app/government/tax/create'


import page404 from '@/components/pages/extras/page404'


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

	// Employee Management
	{
		path: '/app/pis', name: 'employees.index', component: employeesIndex,
		meta: {
			auth: true
		},
	},
	{
		path: '/app/pis/add', name: 'employees.create', component: employeesCreate,
		meta: {
			auth: true
		},
	},
	{
		path: '/app/pis/:id', name: 'employees.show', component: employeesShow,
		meta: {
			auth: true
		},
	},
	{
		path: '/app/pis/:id/edit', name: 'employees.edit', component: employeesEdit,
		meta: {
			auth: true
		},
	},
	{
		path: '/app/pis/:id/:menu', name: 'employees.show.menu', component: employeesShow,
		meta: {
			auth: true
		},
	},


	// Department Management
	{
		path: '/app/department', name: 'department.index', component: departmentIndex,
		meta: {
			auth: true
		},
	},
	{
		path: '/app/department/add', name: 'department.create', component: departmentCreate,
		meta: {
			auth: true
		},
	},
	{
		path: '/app/department/:id', name: 'department.show', component: departmentShow,
		meta: {
			auth: true
		},
	},
	{
		path: '*', name: 'page.404', component: page404,
		meta: {
			auth: false
		},
	},

	// Jobs Management
	{
		path: '/app/jobs', name: 'jobs.index', component: jobsIndex,
		meta: {
			auth: true
		},
	},
	{
		path: '/app/jobs/add', name: 'jobs.create', component: jobsCreate,
		meta: {
			auth: true
		},
	},
	{
		path: '/app/jobs/:id', name: 'jobs.show', component: jobsShow,
		meta: {
			auth: true
		},
	},


	// Compensation Management
	{
		path: '/app/compensation', name: 'compensation.index', component: compensationIndex,
		meta: {
			auth: true
		},
	},
	{
		path: '/app/compensation/add', name: 'compensation.create', component: compensationCreate,
		meta: {
			auth: true
		},
	},
	{
		path: '/app/compensation/assign', name: 'compensation.assign', component: compensationAssign,
		meta: {
			auth: true
		},
	},
	{
		path: '/app/compensation/:id', name: 'compensation.show', component: compensationShow,
		meta: {
			auth: true
		},
	},


	// Deduction Management
	{
		path: '/app/deduction', name: 'deduction.index', component: deductionIndex,
		meta: {
			auth: true
		},
	},
	{
		path: '/app/deduction/add', name: 'deduction.create', component: deductionCreate,
		meta: {
			auth: true
		},
	},
	{
		path: '/app/deduction/assign', name: 'deduction.assign', component: deductionAssign,
		meta: {
			auth: true
		},
	},
	{
		path: '/app/deduction/:id', name: 'deduction.show', component: deductionShow,
		meta: {
			auth: true
		},
	},

	// Leave Management
	{
		path: '/app/leaves', name: 'leaves.index', component: leavesIndex,
		meta: {
			auth: true
		},
	},
	{
		path: '/app/createleaves', name: 'leaves.create', component: leavesCreate,
		meta: {
			auth: true
		},
	},
	{
		path: '/app/leave/:id', name: 'leaves.show', component: leavesShow,
		meta: {
			auth: true
		},
	},

	// Leave credit Management
	{
		path: '/app/leavecredits', name: 'leavecredit.index', component: leaveCreditIndex,
		meta: {
			auth: true
		},
	},
	{
		path: '/app/assign-leavecredits', name: 'leavecredit.assign', component: leaveCreditAssign,
		meta: {
			auth: true
		},
	},

	// Sss List Management
	{
		path: '/app/government/sss', name: 'government.sss.index', component: sssgovtIndex,
		meta: {
			auth: true
		},
	},
	{
		path: '/app/government/sss/add', name: 'government.sss.create', component: sssgovtCreate,
		meta: {
			auth: true
		},
	},

	//Tax List Management
	{
		path: '/app/government/tax', name: 'government.tax.index', component: taxgovtIndex,
		meta: {
			auth: true
		},
	},
	{
		path: '/app/government/tax/add', name: 'government.tax.create', component: taxgovtCreate,
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
	else {
		next()
	}
});

export default router
