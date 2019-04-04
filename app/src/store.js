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
		version: '0.0.3',
		d: '20180329',


		/**
		 * Employees Details API Tunnel
		 *
		 */
        empdtls: 'http://localhost/caimitoapps-payroll/dev/empdtls/api/',


		/**
		 * Authentication API Tunnel
		 *
		 */
        authenticator: 'http://localhost/caimitoapps-payroll/dev/authenticator/api/',




		/**
		 * Misc Variables
		 *
		 */
		authenticated: false,
		errorStatus: '',

    },

})

export default store
