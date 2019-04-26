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
		version: 'v0.0.9',
		d: 'd20190412',


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
		 * Deduction API Tunnel
		 *
		 */

        // deduc: 'http://localhost/www/iplus/payroll/dev/deduc/'
        deduc: 'http://localhost/Iplus/caimitoapps-payroll/deduc/',



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
