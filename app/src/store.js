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
        pis: 'http://localhost/caimitoapps-payroll/dev2/pis/api/',


		/**
		 * Compensation API Tunnel
		 *
		 */
        comp: 'http://localhost/caimitoapps-payroll/dev2/comp/',


		/**
		 * Authentication API Tunnel
		 *
		 */
        authenticator: 'http://localhost/caimitoapps-payroll/dev2/authenticator/api/',


        /**
         * Authentication API Tunnel
         *
         */
        hl: 'http://localhost/caimitoapps-payroll/dev2/hl/',



		/**
		 * Misc Variables
		 *
		 */
		authenticated: false,
		errorStatus: '',

    },

})

export default store
