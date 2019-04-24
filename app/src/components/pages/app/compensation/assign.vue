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
					Assign Compensation
				</div>
				<div class="card-body">

					<notif :notif="notif"></notif>
					<div class="clearfix"></div>

					<form @submit.prevent="compensationAssigning()" method="POST">
						<div class="row">

							<!-- Left side -->
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-4">Select compensation <span class="required">*</span></div>
									<div class="col-md-8">
										<span v-if="!index_compensation_loading">
											<select v-model="assign_compensation.compensation_id" class="form-control form-control-sm">
												<option :value="null">Select one</option>
												<option :value="comp.compensation_id" v-for="comp in compensation.data">
													{{ comp.code }}
													{{ comp.name }}
												</option>
											</select>
										</span>
										<span v-else>
											fetching..
										</span>
									</div>
								</div>
								<div class="clearfix"></div><br />

								<div v-if="assign_compensation.compensation_id != null">
									<div v-if="compensation.data.filter(x => x.compensation_id == assign_compensation.compensation_id)[0].type == 'variable'">
										<div class="row">
											<div class="col-md-4">Amount <span class="required">*</span></div>
											<div class="col-md-8">
												<input type="text" v-model="assign_compensation.amount" id="" class="form-control form-control-sm" required>
												<small>
													<span class="fa fa-info-circle"></span>
													this compensation is a variable, amount field is required <span class="required">*</span>
												</small>
											</div>
										</div>
										<div class="clearfix"></div><br />
									</div>
								</div>

								<div class="row">
									<div class="col-md-4">Date Start <span class="required">*</span></div>
									<div class="col-md-8">
										<input type="date" v-model="assign_compensation.date_start" id="" class="form-control form-control-sm" required>
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
														<input :checked="assign_compensation.user_id.includes(employee.user_id)" type="checkbox" @click="appendEmployee(employee.user_id, employee.fname + ' ' + employee.lname)">
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
			search_show_nothing: true, // to NOT output all employee, user must search only

			compensation: [],
			index_compensation_loading: false,
			selected_compensation: {},

			employees: [],
			employees_filtered: [],
			index_employees_loading: true,

			assign_compensation: {
				compensation_id: null,
				user_id: [],
				taxable: null,
			},
			create_assign_loading: false,

			notif: '',
			search_show: false,
			links: [
				{
					'label': 'Compensation',
					'route': 'compensation.index',
					'params': {}
				}
			]
		}
	},

	created () {
		this.compensationIndex()
		this.employeesIndex()
	},

	methods: {

		select_compensation (se) {
			this.selected_compensation = se
			console.log(se)
		},

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

		// searchEmployee () {
		//
		// 	let employees = this.employees.data
		// 	let that = this
		// 	let arr = this.employees.data
		// 	let query = that.search_employee
		//
		// 	if (query != '') {
		//
		// 		this.search_show_nothing = false
		// 		this.searching_employee = true
		// 		arr.map(function(algo){
		// 			query.split(" ").map(function (word){
		// 				if(
		// 					(algo.fname.toLowerCase().indexOf(word.toLowerCase()) != -1) ||
		// 					(algo.lname.toLowerCase().indexOf(word.toLowerCase()) != -1) ||
		// 					(algo.employee_code.toLowerCase().indexOf(word.toLowerCase()) != -1)
		// 				){
		// 					that.employees_filtered = [algo]
		// 				}
		// 			})
		// 		})
		// 		this.searching_employee = false
		// 	}
		// 	else {
		// 		this.search_show_nothing = true
		// 		this.employees_filtered = this.employees.data
		// 	}
		//
		//
		// },

		taxOption (option) {
			this.assign_compensation.taxable = option
		},

		appendEmployee (id, name) {

			let that = this
			if (this.assign_compensation.user_id.includes(id)) {
				this.assign_compensation.user_id.splice( this.assign_compensation.user_id.indexOf(id), 1 );
				this.selected_employee_info.splice( this.selected_employee_info.indexOf(name), 1 );
			}
			else {
				this.assign_compensation.user_id.push(id)
				this.selected_employee_info.push(name)
				// this.selected_employee_info.push(this.assign_compensation.user_id.map(function (x) {
				// 	for (var i = 0; i < that.employees.data.length; i++) {
				// 		if (that.employees.data[i].user_id == id) {
				// 			return that.employees.data[i].fname + ' ' + that.employees.data[i].lname
				// 		}
				// 	}
				// }))
			}
		},

		compensationIndex () {

			this.index_compensation_loading = true
			this.axiosRequest ('GET', this.$store.state.comp + 'compensation?filter=all')
			.then (res => {
				this.compensation = res.data.data
				this.index_compensation_loading = false

			})
			.catch (err => {
				console.log(err)
				this.index_compensation_loading = false
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

		compensationAssigning () {
			this.create_assign_loading = true

			this.axiosRequest ('POST', this.$store.state.comp + 'assign-compensation', this.assign_compensation)
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
