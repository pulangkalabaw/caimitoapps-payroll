<template lang="html">
	<div class="">

		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

		<div id="content">
			<div class="card">
				<div class="card-header">Homepage</div>
				<div class="card-body">
					a homepage for everybody
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data () {
		return {
			employees: [],
			employees_loading: true,
			links: [
				{
					'label': 'Home',
					'route': 'home',
					'params': {}
				}
			]
		}
	},

	created () {
		this.employeeIndex ();
	},

	methods: {

		employeeIndex () {

			this.employees_loading = true
			this.axiosRequest ('GET', this.$store.state.empdtls + 'employee')
			.then (res => {

				this.employees  = res.data.data
				this.employees_loading = false

			})
			.catch (err => {
				console.log(err)
				this.employees_loading = false
			})
		}
	}
}
</script>

<style lang="css" scoped>
</style>
