<template lang="html">
	<div class="">

		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

		<div id="content">
			<div class="card">
				<div class="card-header">
					<span class="fa fa-users"></span>
					Employees
				</div>
				<div class="card-body">
					<div v-if="!employees_loading">
						<table class="table table-bordered table-hovered" style="width:100%">
							<thead>
								<tr>
									<th>Full name</th>
									<th>Email</th>
									<th>Date created</th>
								</tr>
							</thead>

							<tbody v-for="employee in employees.data.data" :key="employee.id">
								<tr>
									<td>
										<span class="span-link-underline">
											{{ employee.lname }},
											{{ employee.fname }}
											{{ employee.mname }}
										</span>
									</td>
									<td>{{ employee.email }}</td>
									<td>{{ $moment(employee.created_at).format('LL') }}</td>
								</tr>
							</tbody>

						</table>

						<hr>
						Total employees: <b>{{ employees.total }}</b>
						<br /><br />
						<pagination :data="employees.data" @pagination-change-page="employeeIndex"></pagination>

					</div>
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
					'label': 'Employees',
					'route': 'employees.index',
					'params': {}
				}
			]
		}
	},

	created () {
		this.employeeIndex ();
		this.$notify({
			group: 'notif',
			title: 'Important message',
			text: 'Hello user! This is a notification!',
			type: 'success',
		});
	},

	methods: {

		employeeIndex (page = 1) {

			this.employees_loading = true
			this.axiosRequest ('GET', this.$store.state.empdtls + 'employee?page=' + page)
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
