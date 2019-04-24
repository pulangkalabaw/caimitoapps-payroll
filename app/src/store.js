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
		version: 'v0.0.15',
		d: 'd20190424',


		/**
		 * Employees Details API Tunnel
		 *
		 */

        pis: 'http://localhost/caimitoapps-payroll/dev/pis/api/',

		/**
		 * Compensation API Tunnel
		 *
		 */

        comp: 'http://localhost/caimitoapps-payroll/dev/comp/',

		/**
		 * Deduction API Tunnel
		 *
		 */

        deduc: 'http://localhost/caimitoapps-payroll/dev/deduc/',



		/**
		 * Authentication API Tunnel
		 *
		 */

        authenticator: 'http://localhost/caimitoapps-payroll/dev/authenticator/api/',


        /**
         * Holiday Leave API Tunnel
         *
         */

        hl: 'http://localhost/caimitoapps-payroll/dev/hl/',




		/**
		 * Misc Variables
		 *
		 */
		authenticated: false,
		errorStatus: '',

    },

})

export default store
