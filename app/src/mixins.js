import Vue from 'vue';

export default Vue.mixin({
    methods: {


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
