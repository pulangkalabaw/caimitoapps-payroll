<template lang="html">
	<div class="">

		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

		<div id="content">

			<!-- Sub menus -->
			<span @click="redirect('department.index')" class="btn btn-default btn-sm btn-tunch-default">
				<span class="fa fa-th-list"></span>
				View all
			</span>
			<div class="clearf"></div><br />


			<div class="card">
				<div class="card-header">
					<span class="fa fa-folder"></span>
					Create new Department
				</div>
				<div class="card-body">

					<notif :notif="notif"></notif>
					<div class="clearfix"></div>

					<form @submit.prevent="departmentCreate()" method="POST">

						<div class="row">

							<!-- left Side -->
							<div class="col-md-6">
								<div class="row" v-if="!employees_loading">
									<div class="col-md-4">Department Head</div>
									<div class="col-md-8">
										<!--  -->
										<span v-if="selected_employee_info">
											{{ selected_employee_info }}
											<small @click="clearDepartmentHead()" class="span-link">
												<span class="fa fa-times"></span>
												<b><i><u>Clear</u></i></b>
											</small>
										</span>
										<span v-else>
											No Department Head
										</span>
										<br />

										<!--  -->
										<small v-if="!search_show" @click="search_show = true" class="span-link">
											<i><u>Select employee</u></i>
										</small>
										<small v-else @click="search_show = false"  class="span-link">
											<i><u>Done selecting</u></i>
										</small>
										<div class="clearfix"></div><br />


									</div>
								</div>
								<div class="clearfix"></div><br />

								<div class="row">
									<div class="col-md-4">Department Name <span class="required">*</span></div>
									<div class="col-md-8">
										<input type="text" v-model="department.department_name" class="form-control form-control-sm" required>
									</div>
								</div>
								<div class="clearfix"></div><br />

								<div class="row">
									<div class="col-md-4">Description</div>
									<div class="col-md-8">
										<textarea v-model="department.description" class="form-control form-control-sm" cols="30" rows="10"></textarea>
									</div>
								</div>
								<div class="clearfix"></div><br />


								<div class="row">
									<div class="col-md-12 text-right">
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
							</div>

							<!-- Right side -->
							<div class="col-md-6">
								<div class="col-md-12" v-if="search_show" style="padding: 30px; background: rgba(0,0,0,.09)">
									<div class="row">
										<div class="col-md-12">
											<span v-if="!index_employees_loading">
												<input placeholder="search employee" type="text" v-model="search_employee" id="" @keyup="filterEmployees()" class="form-control form-control-sm"><br />
											</span>
											<span v-else>
												fetching..
											</span>

											<!-- Employees -->
											<span v-if="!search_show_nothing">
												<small>Employees({{ employees_filtered.length }})</small><br />
												<span v-if="!search_result_failed">
													<span v-for="employee in employees_filtered">
														<label>
															<input :checked="department.department_head == employee.user_id" type="radio" @click="appendEmployee(employee.user_id, employee.employee_code + ' ' + employee.fname + ' ' + employee.lname)">
															{{ employee.employee_code }}
															{{ employee.fname }}
															{{ employee.lname }}
														</label>
														&nbsp;
													</span>
												</span>
												<span v-else>
													No result
												</span>
											</span>
											<span v-else>
												<small>
													Search for employee's first,last name and employee code
												</small>
											</span>
										</div>
									</div>

								</div>
							</div>
						</div>

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

			search_employee: '',
			selected_employee_info: '',
			search_result_failed: false,
			search_show_nothing: true, // to NOT output all employee, user must search only
			search_show: false,
			employees_filtered: [],


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
				},
				{
					'label': 'Create',
					'route': 'department.create',
					'params': {}
				}
			]
		}
	},

	created () {
		this.employeeIndex ();
	},

	methods: {

		filterEmployees () {
			let employees = this.employees.data
			let that = this
			let arr = this.employees.data
			let search_str = that.search_employee

			if (search_str != '') {

				this.search_show_nothing = false
				this.employees_filtered = arr.filter(x => {
					return x.fname.toLowerCase().includes(search_str) ||
					x.lname.toLowerCase().includes(search_str) ||
					x.employee_code.toLowerCase().includes(search_str)
				})

				this.search_result_failed = this.employees_filtered.length == 0 ? true : false
			}
			else {

				this.search_show_nothing = true
				this.employees_filtered = this.employees.data
			}
		},

		appendEmployee (id, name) {
			this.department.department_head = id
			this.selected_employee_info = name
		},

		clearDepartmentHead() {
			this.department.department_head = null
			this.selected_employee_info = null
		},

		departmentCreate () {
			this.create_department_loading = true
			this.axiosRequest ('POST', this.$store.state.pis + 'department', this.department)
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
			this.axiosRequest ('GET', this.$store.state.pis + 'employee?filter=active')
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
