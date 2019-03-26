<template lang="html">
	<div class="">
		<div class="content-header">
			Home
		</div>
		<div class="clearfix"></div><br />

		<div class="" id="content">
			<div v-if="!employees_loading">
				<ul v-for="employee in employees">
					<li>
						{{ employee }}
					</li>
				</ul>
			</div>
			<div v-else>
				<span class="fa fa-refresh fa-spin"></span>
				Loading please wait ..
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data () {
		return {
			employees: [],
			employees_loading: true
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
