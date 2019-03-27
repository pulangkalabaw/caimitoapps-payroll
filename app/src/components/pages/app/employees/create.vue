<template lang="html">
	<div class="">

		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

		<div id="content">
			<div class="card">
				<div class="card-header">
					<span class="fa fa-users"></span>
					Create new Employee
				</div>
				<div class="card-body">


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
						<form @submit.prevent="employeeCreate()" method="POST">

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


										<div class="row">
											<div class="col-md-12">
												Password <span class="required">*</span><br />
												<input type="password" v-model="employee.password" class="form-control form-control-sm" required>
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Confirm Password <span class="required">*</span><br />
												<input type="password" v-model="employee.password_confirmation" class="form-control form-control-sm" required>
											</div>
										</div>
										<div class="clearfix"></div><br />
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 text-right">
										<button class="btn btn-success btn-sm" :disabled="create_employee_loading">
											<span v-if="create_employee_loading">
												Submiting..
												<span class="fa fa-cog" :class="{ 'fa-spin': create_employee_loading }"></span>
											</span>
											<span v-else>
												Skip and Submit
												<span class="fa fa-cog" :class="{ 'fa-spin': create_employee_loading }"></span>
											</span>
										</button>
										<span @click="currentTab ='oi'" class="btn btn-primary btn-sm">
											Next Step
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
												<input type="text" v-model="employee.mobile_number" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Present Address<br />
												<textarea name="name" v-model="employee.present_address" class="form-control form-control-sm" rows="4"></textarea>
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Province Address<br />
												<textarea name="name" v-model="employee.province_address" class="form-control form-control-sm" rows="4"></textarea>
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Birth date<br />
												<input type="text" v-model="employee.birth_date" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Birth place<br />
												<input type="text" v-model="employee.birth_place" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

									</div>

									<div class="col-md-6">

										<div class="row">
											<div class="col-md-12">
												Religion<br />
												<input type="text" v-model="employee.religion" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Marital Status<br />
												<input type="text" v-model="employee.marital_status" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Gender<br />
												<select class="form-control form-control-sm" v-model="employee.gender">
													<option value="male">Male</option>
													<option value="female">Female</option>
												</select>
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Height<br />
												<input type="text" v-model="employee.height" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Weight<br />
												<input type="text" v-model="employee.weight" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Date hired<br />
												<input type="date" v-model="employee.date_hired" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

									</div>
								</div>

								<div class="row">
									<div class="col-md-12 text-right">
										<button class="btn btn-success btn-sm" :disabled="create_employee_loading">
											<span v-if="create_employee_loading">
												Submiting..
												<span class="fa fa-cog" :class="{ 'fa-spin': create_employee_loading }"></span>
											</span>
											<span v-else>
												Skip and Submit
												<span class="fa fa-cog" :class="{ 'fa-spin': create_employee_loading }"></span>
											</span>
										</button>
										<span @click="currentTab ='bi'" class="btn btn-primary btn-sm">
											<span class="fa fa-chevron-left"></span>
											Back
										</span>
										<span @click="currentTab ='pd'" class="btn btn-primary btn-sm">
											Next Step
											<span class="fa fa-chevron-right"></span>
										</span>
									</div>
								</div>
								<div class="clearfix"></div><br />

							</div>

							<!-- Other Information -->
							<div v-if="currentTab == 'de'">
								<br />
								<b>Department</b><br /><br />

								<div class="row">
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-12" v-if="!departments_loading">
												Department<br />
												<select class="form-control form-control-sm" v-model="employee.department_id" required>
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
										<button class="btn btn-success btn-sm" :disabled="create_employee_loading">
											<span v-if="create_employee_loading">
												Submiting..
												<span class="fa fa-cog" :class="{ 'fa-spin': create_employee_loading }"></span>
											</span>
											<span v-else>
												Skip and Submit
												<span class="fa fa-cog" :class="{ 'fa-spin': create_employee_loading }"></span>
											</span>
										</button>
										<span @click="currentTab ='oi'" class="btn btn-primary btn-sm">
											<span class="fa fa-chevron-left"></span>
											Back
										</span>
										<span @click="currentTab ='pd'" class="btn btn-primary btn-sm">
											Next Step
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
												<input type="text" v-model="employee.basic_salary" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Allowance<br />
												<select class="form-control form-control-sm" disabled>
												</select>
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Loans<br />
												<select class="form-control form-control-sm" disabled>
												</select>
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Wage type<br />
												<select class="form-control form-control-sm" v-model="employee.wage_type">
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
												<input type="text" v-model="employee.bank_details" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												Payout type<br />
												<select class="form-control form-control-sm" v-model="employee.payout_type">
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
												<select class="form-control form-control-sm" v-model="employee.tax_computation">
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
												<input type="text" v-model="employee.tin_number" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												SSS number<br />
												<input type="text" v-model="employee.sss_number" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												PhilHealth number<br />
												<input type="text" v-model="employee.philhealth_number" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-12">
												HMDF number<br />
												<input type="text" v-model="employee.hdmf_number" class="form-control form-control-sm">
											</div>
										</div>
										<div class="clearfix"></div><br />

									</div>
								</div>

								<div class="row">
									<div class="col-md-12 text-right">
										<span @click="currentTab ='de'" class="btn btn-primary btn-sm">
											<span class="fa fa-chevron-left"></span>
											Back
										</span>
										<button class="btn btn-success btn-sm" :disabled="create_employee_loading">
											<span v-if="create_employee_loading">
												Submiting..
												<span class="fa fa-cog" :class="{ 'fa-spin': create_employee_loading }"></span>
											</span>
											<span v-else>
												Submit
												<span class="fa fa-cog" :class="{ 'fa-spin': create_employee_loading }"></span>
											</span>
										</button>
									</div>
								</div>
								<div class="clearfix"></div><br />

							</div>

						</form>
					</div>
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
			employee: {
				email: 'kllopez@iplusonline.com',
				password: 'kllopez@iplusonline.com',
				password_confirmation: 'kllopez@iplusonline.com',
			},
			create_employee_loading: false,

			departments: [],
			departments_loading: false,

			submit_button_label: 'Skip and Submit',
			notif: '',

			links: [
				{
					'label': 'Employees',
					'route': 'employees.index',
					'params': {}
				},
				{
					'label': 'Add',
					'route': 'employees.create',
					'params': {}
				}
			],
			tabs: [
				{ title: 'Basic Information', value: 'bi' },
				{ title: 'Other Information', value: 'oi' },
				{ title: 'Department', value: 'de' },
				{ title: 'Payroll Details', value: 'pd' },
			],
			currentTab: 'bi',
		}
	},

	created () {
		this.departmentIndex()
	},

	methods: {

		handleClick(newTab) {
			this.currentTab = newTab;
		},

		departmentIndex () {

			this.departments_loading = true
			this.axiosRequest ('GET', this.$store.state.empdtls + 'department?show=all')
			.then (res => {
				this.departments = res.data.data
				this.departments_loading = false
			})
			.catch(err => {
				console.log(err)
			})
				this.departments_loading = false
		},

		employeeCreate () {

			this.create_employee_loading = true
			this.axiosRequest ('POST', this.$store.state.empdtls + 'employee', this.employee)
			.then (res => {

				this.notif = res.data
				if (res.data.status == 'success') {
					this.$notify({
						group: 'notif',
						title: 'Employee',
						text: res.data.message,
						type: 'success',
					});
				}
				else {
					this.$notify({
						group: 'notif',
						title: 'Employee',
						text: res.data.message,
						type: 'error',
					});
				}
				console.log(res.data)
				this.create_employee_loading = false

			})
			.catch (err => {
				console.log(err)
				this.create_employee_loading = false
			})

			console.log(this.employee)
		}
	}
}
</script>
