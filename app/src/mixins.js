import Vue from 'vue';

export default Vue.mixin({
	methods: {

		/**
		* PIS Mixins
		*/
		employementType (string) {
			let r;

			switch (string) {
				case 'probational':
				r = 'Probational';
				break;

				case 'project_based':
				r = 'Project Based';
				break;

				case 'regular':
				r = 'Regular';
				break;

				default:
				'-'
			}
			return r
		},


		/**
		* General Mixins
		*/
		tnotif (res) {
			this.$notify({
				group: 'notif',
				title: 'Employee',
				text: res.data.message,
				type: res.data.status == 'success' ? 'success' : 'error',
			});
		},


		str_limit (str, limit = 50) {

			var r = str.substring(0,limit)
			if (str.length > limit) {
				r = r + '..'
			}
			return r
		},

		now () {
			const toTwoDigits = num => num < 10 ? '0' + num : num;
			let today = new Date();
			let year = today.getFullYear();
			let month = toTwoDigits(today.getMonth() + 1);
			let day = toTwoDigits(today.getDate());
			return `${year}-${month}-${day}`;
		},

		ucfirst(string) {
			return string.charAt(0).toUpperCase() + string.slice(1);
		},

		redirect (route_name, params = {}, query = {}) {
			this.$router.push({ name: route_name , params : params, query: query })
		},

		// method, url, params, options
		axiosRequest (method, url, params, headers, api_token = true) {

			//  CHECK GET PARAMS
			url =  (url.includes('?') ? url + '&' : url + '?')
			// CHECK API TOKEN
			url = (api_token == true ? url + 'at=' + this.$session.get('at') : url)

			// ***************
			const instance = this.$axios({
				method: method,
				url: url,
				data: params,
				headers: headers,
				timeout: 60000,
				responseType: 'json',
			});

			// ***************
			let checker = instance
			// ***************
			checker.then(res => {
				this.$store.state.errorStatus = '';
			})
			checker.catch(error => {
				console.log(error)
				if (!error.response) {
					// network error
					this.$store.state.errorStatus = 'Error: Network Error';
				} else {
					this.$store.state.errorStatus = error.response.data.message;
				}
			})
			// RETURN INSTANCE
			return instance;
		},

	}
})
