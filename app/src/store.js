import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

const store =  new Vuex.Store({
    state: {

		/**
		 * Global Variable
		 *
		 */
		app_url: 'http://192.168.1.44:3000',
		project_name: 'Payroll Application',
		version: '0.0.3',
		d: '20180329',


		/**
		 * Employees Details API Tunnel
		 *
		 */
        pis: 'http://192.168.1.44/www/iplus/payroll/dev/pis/api/',


		/**
		 * Compensation API Tunnel
		 *
		 */
        comp: 'http://192.168.1.44/www/iplus/payroll/dev/comp/',


		/**
		 * Authentication API Tunnel
		 *
		 */
        authenticator: 'http://192.168.1.49/caimitoapps-payroll/dev/authenticator/api/',




		/**
		 * Misc Variables
		 *
		 */
		authenticated: false,
		errorStatus: '',

    },

})

export default store
