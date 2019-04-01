<template lang="html">
	<div class="">

		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

		<div id="content">
			<div class="card">
				<div class="card-header">
					<span class="fa fa-folder"></span>
					Create new Department
				</div>
				<div class="card-body">

					<notif :notif="notif"></notif>
					<div class="clearfix"></div>

					<form @submit.prevent="departmentCreate()" method="POST">

						<div class="row" v-if="!employee_loading">
							<div class="col-md-2">Department Head</div>
							<div class="col-md-4">
								<select v-model="department.department_head" class="form-control form-control-sm">
									<option :value="employee.user_id" v-for="employee in employees">
										{{ employee.lname }},
										{{ employee.fname }}
									</option>
								</select>
							</div>
						</div>
						<div class="clearfix"></div><br />

						<div class="row">
							<div class="col-md-2">Department Name <span class="required">*</span></div>
							<div class="col-md-4">
								<input type="text" v-model="department.department_name" class="form-control form-control-sm" required>
							</div>
						</div>
						<div class="clearfix"></div><br />

						<div class="row">
							<div class="col-md-2">Description</div>
							<div class="col-md-4">
								<textarea v-model="department.description" class="form-control form-control-sm" cols="30" rows="10"></textarea>
							</div>
						</div>
						<div class="clearfix"></div><br />


						<div class="row">
							<div class="col-md-4 offset-md-2 text-right">
								<button class="btn btn-success btn-sm" :disabled="create_department_loading">
									<span v-if="create_department_loading">
										Submiting..
										<span class="fa fa-cog" :class="{ 'fa-spin': create_department_loading }"></span>
									</span>
									<span v-else>
										Submit
										<span class="fa fa-cog" :class="{ 'fa-spin': create_department_loading }"></span>
									</span>
								</button>
							</div>
						</div>
						<div class="clearfix"></div><br />
					</form>


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

			department: {},
			create_department_loading: false,
			notif: '',

			links: [
				{
					'label': 'Department',
					'route': 'department.index',
					'params': {}
				}
			]
		}
	},

	created () {
		this.employeeIndex ();
	},

	methods: {

		departmentCreate () {
			this.create_department_loading = true
			this.axiosRequest ('POST', this.$store.state.empdtls + 'department', this.department)
			.then (res => {

				this.notif = res.data
				this.tnotif (res)
				this.employees  = res.data.data.data
				this.create_department_loading = false

			})
			.catch (err => {
				console.log(err)
				this.create_department_loading = false
			})
		},

		employeeIndex () {

			this.employees_loading = true
			this.axiosRequest ('GET', this.$store.state.empdtls + 'employee?show=all')
			.then (res => {

				this.employees  = res.data.data.data
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
