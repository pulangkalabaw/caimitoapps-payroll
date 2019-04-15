<template lang="html">
	<div class="">

		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

		<div id="content">

			<!-- Sub Menus -->
			<span @click="redirect('compensation.create')" class="btn btn-primary btn-sm btn-tunch">
				<span class="fa fa-plus-circle"></span>
				Create new
			</span>
			<span @click="redirect('compensation.index')" class="btn btn-default btn-sm btn-tunch-default">
				<span class="fa fa-th-list"></span>
				View all
			</span>
			<div class="clearfix"></div><br />


			<div class="card">
				<div class="card-header">
					<span class="fa fa-folder"></span>
					Assign Deduction
				</div>
				<div class="card-body">

					<notif :notif="notif"></notif>
					<div class="clearfix"></div>

					<form @submit.prevent="deductionAssigning()" method="POST">
						<div class="row">

							<!-- Left side -->
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-4">Select deduction <span class="required">*</span></div>
									<div class="col-md-8">
										<span v-if="!index_deduc_loading">
											<select v-model="assign_deduc.deduction_id" class="form-control form-control-sm">
												<option :value="null">Select one</option>
												<option :value="dd.deduction_id" v-for="dd in deduction.data">
													{{ dd.name }}
												</option>
											</select>
										</span>
										<span v-else>
											fetching..
										</span>
									</div>
								</div>
								<div class="clearfix"></div><br />

								<div class="row">
									<div class="col-md-4">Tax option <span class="required">*</span></div>
									<div class="col-md-8">
										<label>
											<input type="radio" value="bp" name="tax" @click="taxOption('bp')">
											Before Payroll
										</label>
										<label>
											<input type="radio" value="ap" name="tax" @click="taxOption('ap')">
											After Payroll
										</label>
									</div>
								</div>
								<div class="clearfix"></div><br />


								<div class="row">
									<div class="col-md-4">Employee <span class="required">*</span></div>
									<div class="col-md-8">

										<!--  -->
										<span v-for="(selected_info, index) in selected_employee_info">
											{{ selected_info }}
											<span v-if="index < selected_employee_info.length - 1">,</span>
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
									<div class="col-md-12 text-right">
										<button class="btn btn-success btn-sm" :disabled="create_assign_loading">
											<span v-if="create_assign_loading">
												Submiting..
												<span class="fa fa-cog" :class="{ 'fa-spin': create_assign_loading }"></span>
											</span>
											<span v-else>
												Submit
												<span class="fa fa-cog" :class="{ 'fa-spin': create_assign_loading }"></span>
											</span>
										</button>
									</div>
								</div>
							</div>

							<!-- Right side -->
							<div class="col-md-6" v-if="search_show" style="padding: 30px; background: rgba(0,0,0,.09)">
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
														<input :checked="assign_deduc.user_id.includes(employee.user_id)" type="checkbox" @click="appendEmployee(employee.user_id, employee.fname + ' ' + employee.lname)">
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

			search_employee: '',
			selected_employee_info: [],
			search_result_failed: false,
			search_show_nothing: true, // to not output all employee, user must search only

			deduction: [],
			index_deduc_loading: false,

			employees: [],
			employees_filtered: [],
			index_employees_loading: true,

			assign_deduc: {
				deduction_id: null,
				user_id: [],
				taxable: null,
			},
			create_assign_loading: false,

			notif: '',
			search_show: false,
			links: [
				{
					'label': 'Deductions',
					'route': 'deduction.index',
					'params': {}
				}
			]
		}
	},

	created () {
		this.deductionIndex()
		this.employeesIndex()
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

		taxOption (option) {
			this.assign_deduc.taxable = option
		},

		appendEmployee (id, name) {

			let that = this
			if (this.assign_deduc.user_id.includes(id)) {
				this.assign_deduc.user_id.splice( this.assign_deduc.user_id.indexOf(id), 1 );
				this.selected_employee_info.splice( this.selected_employee_info.indexOf(name), 1 );
			}
			else {
				this.assign_deduc.user_id.push(id)
				this.selected_employee_info.push(name)
				// this.selected_employee_info.push(this.assign_deduc.user_id.map(function (x) {
				// 	for (var i = 0; i < that.employees.data.length; i++) {
				// 		if (that.employees.data[i].user_id == id) {
				// 			return that.employees.data[i].fname + ' ' + that.employees.data[i].lname
				// 		}
				// 	}
				// }))
			}
		},

		deductionIndex () {

			this.index_deduc_loading = true
			this.axiosRequest ('GET', this.$store.state.deduc + 'deduction?filter=all')
			.then (res => {
				this.deduction = res.data.data
				this.index_deduc_loading = false

			})
			.catch (err => {
				console.log(err)
				this.index_deduc_loading = false
			})
		},

		employeesIndex () {

			this.index_employees_loading = true
			this.axiosRequest ('GET', this.$store.state.pis + 'employee?filter=all')
			.then (res => {
				this.employees = res.data.data
				this.employees_filtered = this.employees.data
				this.index_employees_loading = false
			})
			.catch (err => {
				console.log(err)
				this.index_employees_loading = false
			})
		},

		deductionAssigning () {
			this.create_assign_loading = true

			this.axiosRequest ('POST', this.$store.state.deduc + 'assign-deduction', this.assign_deduc)
			.then (res => {
				console.log(res)
				this.notif = res.data
				this.tnotif (res)
				this.create_assign_loading = false

			})
			.catch (err => {
				console.log(err)
				this.create_assign_loading = false
			})
		},

	}
}
</script>

<style lang="css" scoped>
</style>
