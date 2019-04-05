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
									<th>Date hired</th>
								</tr>
							</thead>

							<tbody v-for="employee in employees.data.data" :key="employee.id">
								<tr>
									<td>
										<span class="span-link-underline" @click="redirect('employees.show', {id:employee.user_id})">
											{{ employee.lname }},
											{{ employee.fname }}
											{{ employee.mname }}
										</span>
									</td>
									<td>{{ employee.email }}</td>
									<td>
										<span v-if="employee.user_details != null">
											<span v-if="employee.user_details.date_hired != null">
												{{ $moment(employee.user_details.date_hired).format('LL') }}
											</span>
											<span v-else>
												No date selected
											</span>
										</span>
										<span v-else>
											No date selected
										</span>
									</td>
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
	},

	methods: {

		employeeIndex (page = 1) {

			this.employees_loading = true
			this.axiosRequest ('GET', this.$store.state.pis + 'employee?page=' + page)
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
