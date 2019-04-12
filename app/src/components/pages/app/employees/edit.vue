<template lang="html">
	<div class="">

		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

		<div id="content" v-if="!show_employee_loading">

			<!-- Sub Menus -->
			<span @click="redirect('employees.create')" class="btn btn-primary btn-sm btn-tunch">
				<span class="fa fa-plus-circle"></span>
				Create new
			</span>
			<span @click="redirect('employees.index')" class="btn btn-default btn-sm btn-tunch-default">
				<span class="fa fa-th-list"></span>
				View all
			</span>
			<div class="clearfix"></div><br />


			<div class="card" :class="{ 'border-warning ': edit_mode }">
				<div class="card-header">
					<div class="row">
						<div class="col-md-6">
							<span class="fa fa-users"></span>
							Employee
						</div>
						<div class="col-md-6 text-right" v-if="valid">
							<span class="span-link btn-sm" @click="redirect('employees.show', {id:employee.user_id})">
								<span class="fa fa-eye"></span>
								Exit Edit Profile
							</span>
						</div>

					</div>
				</div>
				<div class="card-body" v-if="valid">

					<div class="alert alert-warning" v-if="edit_mode">
						<span class="fa fa-warning"></span>
						<b>Warning!</b> You are in
						<b>Edit Mode</b>
					</div>
					<div class="alert alert-info" v-else>
						<span class="fa fa-info-circle"></span>
						You are in
						<b>View mode</b>
					</div>


					<notif :notif="notif"></notif>
					<div class="clearfix"></div>

					<tabs
					:tabs="tabs"
					:currentTab="currentTab"
					:wrapper-class="'tabs'"
					:tab-class="'tabs__item'"
					:tab-active-class="'tabs__item_active'"
					:line-class="'tabs__active-line'"
					@onClick="handleClick"
					/>
					<div class="content">

						<form @submit.prevent="employeeUpdate()" method="POST">

							<!-- Basic Information -->
							<div v-if="currentTab === 'bi'"><br />

								<div class="row">
									<div class="col-md-6">
										<b>Basic information</b><br /><br />
										<div class="row">
											<div class="col-md-12">
												First name <span class="required">*</span><br />
												<input type="text" v-model="employee.fname" class="form-control form-control-sm" required>
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Middle name <span class="required">*</span><br />
												<input type="text" v-model="employee.mname" class="form-control form-control-sm" required>
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Last name <span class="required">*</span><br />
												<input type="text" v-model="employee.lname" class="form-control form-control-sm" required>
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Suffix <span class="required">*</span><br />
												<select class="form-control form-control-sm" v-model="employee.suffix" required>
													<option value="mr">Mr.</option>
													<option value="mrs">Mrs.</option>
													<option value="ms">Ms.</option>
												</select>
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Employee code <span class="required">*</span><br />
												<input type="text" v-model="employee.employee_code" class="form-control form-control-sm" required>
											</div>
										</div>
										<div class="clearfix"></div><br />
									</div>

									<div class="col-md-6">
										<b>Account information</b><br /><br />
										<div class="row">
											<div class="col-md-12">
												Email <span class="required">*</span><br />
												<input type="email" v-model="employee.email" class="form-control form-control-sm" required>
											</div>
										</div>
										<div class="clearfix"></div><br />


										<div v-if="edit_mode">
											<div class="row">
												<div class="col-md-12">
													Password <br />
													<input type="password" v-model="employee.password" class="form-control form-control-sm">
													<small class="">
														<span class="fa fa-info-circle"></span>
														Leave it blank, if no change
													</small>
												</div>
											</div>
											<div class="clearfix"></div><br />

											<div class="row">
												<div class="col-md-12">
													Confirm Password <br />
													<input type="password" v-model="employee.password_confirmation" class="form-control form-control-sm">
												</div>
											</div>
											<div class="clearfix"></div><br />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 text-right">
										<button class="btn btn-success btn-sm" :disabled="update_employee_loading">
											<span v-if="update_employee_loading">
												Submiting..
												<span class="fa fa-cog" :class="{ 'fa-spin': update_employee_loading }"></span>
											</span>
											<span v-else>
												Skip and Update
												<span class="fa fa-cog" :class="{ 'fa-spin': update_employee_loading }"></span>
											</span>
										</button>
										<span @click="currentTab ='oi'" class="btn btn-primary btn-sm">
											Next
											<span class="fa fa-chevron-right"></span>
										</span>
									</div>
								</div>
								<div class="clearfix"></div><br />

							</div>

							<!-- Other Information -->
							<div v-if="currentTab == 'oi'">
								<br />
								<b>Other information</b><br /><br />

								<div class="row">
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-12">
												Mobile number<br />
												<input type="text" v-model="employee.user_details.mobile_number" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Present Address<br />
												<textarea name="name" v-model="employee.user_details.present_address" class="form-control form-control-sm" rows="4"></textarea>
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Province Address<br />
												<textarea name="name" v-model="employee.user_details.province_address" class="form-control form-control-sm" rows="4"></textarea>
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Birth date<br />
												<input type="text" v-model="employee.user_details.birth_date" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Birth place<br />
												<input type="text" v-model="employee.user_details.birth_place" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

									</div>

									<div class="col-md-6">

										<div class="row">
											<div class="col-md-12">
												Religion<br />
												<input type="text" v-model="employee.user_details.religion" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Marital Status<br />
												<input type="text" v-model="employee.user_details.marital_status" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Gender<br />
												<select class="form-control form-control-sm" v-model="employee.user_details.gender">
													<option value="male">Male</option>
													<option value="female">Female</option>
												</select>
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Height<br />
												<input type="text" v-model="employee.user_details.height" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Weight<br />
												<input type="text" v-model="employee.user_details.weight" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Date hired<br />
												<input type="date" v-model="employee.user_details.date_hired" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

									</div>
								</div>

								<div class="row">
									<div class="col-md-12 text-right">
										<button class="btn btn-success btn-sm" :disabled="update_employee_loading">
											<span v-if="update_employee_loading">
												Submiting..
												<span class="fa fa-cog" :class="{ 'fa-spin': update_employee_loading }"></span>
											</span>
											<span v-else>
												Skip and Update
												<span class="fa fa-cog" :class="{ 'fa-spin': update_employee_loading }"></span>
											</span>
										</button>
										<span @click="currentTab ='bi'" class="btn btn-primary btn-sm">
											<span class="fa fa-chevron-left"></span>
											Back
										</span>
										<span @click="currentTab ='co'" class="btn btn-primary btn-sm">
											Next
											<span class="fa fa-chevron-right"></span>
										</span>
									</div>
								</div>
								<div class="clearfix"></div><br />

							</div>

							<!-- Company Information -->
							<div v-if="currentTab == 'co'">
								<br />
								<b>Department</b><br /><br />

								<div class="row">
									<div class="col-md-6">

										<div class="row">
											<div class="col-md-12">
												Employment type<br />
												<select class="form-control form-control-sm" v-model="employee.user_details.employment_type">
													<option value="probational">Probational</option>
													<option value="project_based">Project Based</option>
													<option value="regular">Regular</option>
												</select>
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Employment type<br />
												<select class="form-control form-control-sm" v-model="employee.user_details.employment_status">
													<option value="hired" selected>Hired</option>
													<option value="resigned">Resigned</option>
												</select>
											</div>
										</div>
										<div class="clearfix"></div><br />


										<div class="row">
											<div class="col-md-12" v-if="!departments_loading">
												Department<br />
												<select class="form-control form-control-sm" v-model="dept_id" required v-if="dept_id != '696969'">
													<option :value="696969">Select none</option>
													<option :value="department.department_id" v-for="department in departments.data">
														{{ department.department_name }}
													</option>
												</select>
												<select class="form-control form-control-sm" v-model="dept_id" v-else>
													<option :value="696969">Select none</option>
													<option :value="department.department_id" v-for="department in departments.data">
														{{ department.department_name }}
													</option>
												</select>


											</div>
										</div>
										<div class="clearfix"></div><br />
									</div>
								</div>

								<div class="row">
									<div class="col-md-12 text-right">
										<button class="btn btn-success btn-sm" :disabled="update_employee_loading">
											<span v-if="update_employee_loading">
												Submiting..
												<span class="fa fa-cog" :class="{ 'fa-spin': update_employee_loading }"></span>
											</span>
											<span v-else>
												Skip and Update
												<span class="fa fa-cog" :class="{ 'fa-spin': update_employee_loading }"></span>
											</span>
										</button>
										<span @click="currentTab ='oi'" class="btn btn-primary btn-sm">
											<span class="fa fa-chevron-left"></span>
											Back
										</span>
										<span @click="currentTab ='pd'" class="btn btn-primary btn-sm">
											Next
											<span class="fa fa-chevron-right"></span>
										</span>
									</div>
								</div>
								<div class="clearfix"></div><br />

							</div>

							<!-- Payroll Details -->
							<div v-if="currentTab == 'pd'">
								<br />
								<b>Payroll Details</b><br /><br />

								<div class="row">
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-12">
												Basic Salary<br />
												<input type="text" v-model="employee.user_payroll_details.basic_salary" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Allowance<br />
												<select v-model="employee.user_payroll_details.allowance" class="form-control form-control-sm" disabled>
												</select>
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Loans<br />
												<select v-model="employee.user_payroll_details.loans" class="form-control form-control-sm" disabled>
												</select>
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Wage type<br />
												<select class="form-control form-control-sm" v-model="employee.user_payroll_details.wage_type">
													<option value="daily">Daily</option>
													<option value="monthly">Monthly</option>
													<option value="fixed">Fixed</option>
												</select>
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Bank Details<br />
												<input type="text" v-model="employee.user_payroll_details.bank_details" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Payout type<br />
												<select class="form-control form-control-sm" v-model="employee.user_payroll_details.payout_type">
													<option value="cash">Cash</option>
													<option value="check">Check</option>
													<option value="atm">ATM</option>
												</select>
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Tax Computataion<br />
												<select class="form-control form-control-sm" v-model="employee.user_payroll_details.tax_computation">
													<option value="none">None</option>
													<option value="annually">Annually</option>
													<option value="table">Table</option>
												</select>
											</div>
										</div>
										<div class="clearfix"></div><br />

									</div>

									<div class="col-md-6">
										<div class="row">
											<div class="col-md-12">
												Tin number<br />
												<input type="text" v-model="employee.user_payroll_details.tin_number" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												SSS number<br />
												<input type="text" v-model="employee.user_payroll_details.sss_number" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												PhilHealth number<br />
												<input type="text" v-model="employee.user_payroll_details.philhealth_number" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												HMDF number<br />
												<input type="text" v-model="employee.user_payroll_details.hdmf_number" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

									</div>
								</div>

								<div class="row">
									<div class="col-md-12 text-right">
										<span @click="currentTab ='co'" class="btn btn-primary btn-sm">
											<span class="fa fa-chevron-left"></span>
											Back
										</span>
										<button class="btn btn-success btn-sm" :disabled="update_employee_loading">
											<span v-if="update_employee_loading">
												Submiting..
												<span class="fa fa-cog" :class="{ 'fa-spin': update_employee_loading }"></span>
											</span>
											<span v-else>
												Submit
												<span class="fa fa-cog" :class="{ 'fa-spin': update_employee_loading }"></span>
											</span>
										</button>
									</div>
								</div>
								<div class="clearfix"></div><br />

							</div>

						</form>

					</div>
				</div>
				<div class="card-body" v-else>
					This page either under maintenance or not exists!
				</div>
			</div>

		</div>
	</div>
</template>

<script>
import Tabs from 'vue-tabs-with-active-line';
export default {
	components: {
		Tabs,
	},
	data () {
		return {
			employee: {},
			show_employee_loading: false,
			update_employee_loading: false,
			valid: false,

			departments: [],
			departments_loading: false,
			dept_id: '696969',

			edit_mode: false,

			notif: '',

			links: [
				{
					'label': 'Employees',
					'route': 'employees.index',
					'params': {}
				},
				{
					'label': 'View',
					'route': '',
					'params': {}
				}
			],
			tabs: [
				{ title: 'Basic Information', value: 'bi' },
				{ title: 'Other Information', value: 'oi' },
				{ title: 'Company', value: 'co' },
				{ title: 'Payroll Details', value: 'pd' },
			],
			currentTab: 'bi',
		}
	},

	created () {
		this.employeeShow()
	},

	methods: {

		editMode (des){
			this.edit_mode = des
			if (des == true) {
				this.$notify({
					group: 'notif',
					title: 'Employee',
					text: 'You are in Edit Mode',
					type: 'warn',
				});
			}
			else {
				this.$notify({
					group: 'notif',
					title: 'Employee',
					text: 'You are in View Mode',
					type: 'info',
				});
			}
		},

		handleClick(newTab) {
			this.currentTab = newTab;
		},

		departmentIndex () {

			this.departments_loading = true
			this.axiosRequest ('GET', this.$store.state.pis + 'department?filter=active')
			.then (res => {
				this.departments = res.data.data
				this.departments_loading = false
			})
			.catch(err => {
				console.log(err)
				this.departments_loading = false
			})
		},

		employeeShow () {

			this.show_employee_loading = true
			this.axiosRequest ('GET', this.$store.state.pis + 'employee/' + this.$route.params.id)
			.then (res => {

				this.employee = res.data.data.data
				this.show_employee_loading = false
				if (this.employee.user_details.department_id != null) {
					this.dept_id = this.employee.user_details.department_id
				}
				else {
					this.dept_id = "696969"
				}
				this.valid = res.data.status == 'success' ? true : false
				this.departmentIndex()

			})
			.catch (err => {
				console.log(err)
				this.show_employee_loading = false
			})

		},

		employeeUpdate () {

			this.update_employee_loading = true
			this.employee._method = 'PUT'

			let dept_id_value = this.dept_id == '696969' ? null : this.dept_id
			this.employee.user_details.department_id = dept_id_value
			this.axiosRequest ('POST', this.$store.state.pis + 'employee/' + this.$route.params.id, this.employee)
			.then (res => {
				this.notif = res.data
				this.update_employee_loading = false
				this.tnotif (res)

			})
			.catch (err => {
				console.log(err)
				this.update_employee_loading = false
			})

		}
	}
}
</script>
