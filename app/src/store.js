import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

const store =  new Vuex.Store({
    state: {

		/**
		 * Global Variable
		 *
		 */
		app_url: 'http://localhost:8080',
		project_name: 'Payroll Application',
		version: '0.0.1',
		d: '20180325',


		/**
		 * Employees Details API Tunnel
		 *
		 */
        empdtls: 'http://10.155.128.210/caimitoapps-payroll/dev/laravel55-template/api/',




		/**
		 * Misc Variables
		 *
		 */
		authenticated: false,
		errorStatus: '',

    },

})

export default store
