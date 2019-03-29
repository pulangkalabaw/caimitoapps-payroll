import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

const store =  new Vuex.Store({
    state: {

		/**
		 * Global Variable
		 *
		 */
		app_url: 'http://10.155.128.148:3000',
		project_name: 'Payroll Application',
		version: '0.0.2',
		d: '20180326',


		/**
		 * Employees Details API Tunnel
		 *
		 */
        empdtls: 'http://10.155.128.210/caimitoapps-payroll/dev/empdtls/api/',




		/**
		 * Misc Variables
		 *
		 */
		authenticated: false,
		errorStatus: '',

    },

})

export default store
