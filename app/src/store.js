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
		version: '0.0.7',
		d: '20180410',


		/**
		 * Employees Details API Tunnel
		 *
		 */

        pis: 'http://localhost/www/iplus/payroll/dev/pis/api/',



		/**
		 * Compensation API Tunnel
		 *
		 */

        comp: 'http://localhost/www/iplus/payroll/dev/comp/',



		/**
		 * Authentication API Tunnel
		 *
		 */

        authenticator: 'http://localhost/www/iplus/payroll/dev/authenticator/api/',



        /**
         * Holiday Leave API Tunnel
         *
         */

        hl: 'http://localhost/www/iplus/payroll/dev/hl/',




		/**
		 * Misc Variables
		 *
		 */
		authenticated: false,
		errorStatus: '',

    },

})

export default store
