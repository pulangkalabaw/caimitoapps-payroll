<template lang="html">
	<div class="">

		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />



		<div id="content">
			<foo-modal name="hello-world">
				hello, world!
			</foo-modal>
			<div class="card">
				<div class="card-header">
					<span class="fa fa-folder"></span>
					Assign Allowance
				</div>
				<div class="card-body">

					<notif :notif="notif"></notif>
					<div class="clearfix"></div>

					{{ assign_compensation }}

					<form @submit.prevent="compensationAssigning()" method="POST">
						<div class="row">

							<!-- Left side -->
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-4">Select allowance <span class="required">*</span></div>
									<div class="col-md-8">
										<span v-if="!index_compensation_loading">
											<select v-model="assign_compensation.allowance_id" class="form-control form-control-sm">
												<option :value="null">Select one</option>
												<option :value="comp.allowance_id" v-for="comp in compensation.data">
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

								<div class="row">
									<div class="col-md-4">Tax <span class="required">*</span></div>
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
											<input placeholder="search employee" type="text" v-model="search_employee" id="" @keyup="searchEmployee()" class="form-control form-control-sm"><br />
										</span>
										<span v-else>
											fetching..
										</span>

										<!-- Employees -->
										<small>Employees</small><br />
										<span v-for="employee in employees_filtered"  v-if="!searching_employee">
											<label>
												<input :checked="assign_compensation.user_id.includes(employee.user_id)" type="checkbox" @click="appendEmployee(employee.user_id, employee.fname + ' ' + employee.lname)">
												{{ employee.employee_code }}
												{{ employee.fname }}
												{{ employee.lname }}
											</label>
											&nbsp;
										</span>
									</div>
								</div>

							</div>
						</div>
						<div class="clear"></div><br />

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
			searching_employee: false,

			compensation: [],
			index_compensation_loading: false,

			employees: [],
			employees_filtered: [],
			index_employees_loading: true,

			assign_compensation: {
				allowance_id: null,
				user_id: [],
				tax: null,
			},
			create_assign_loading: false,

			notif: '',
			search_show: false,
			links: [
				{
					'label': 'Allowances',
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

		searchEmployee () {

			let employees = this.employees.data
			let that = this
			let arr = this.employees.data
			let query = that.search_employee
			if (query != '') {
				this.searching_employee = true
				arr.map(function(algo){
					query.split(" ").map(function (word){
						if(
							(algo.fname.toLowerCase().indexOf(word.toLowerCase()) != -1) ||
							(algo.lname.toLowerCase().indexOf(word.toLowerCase()) != -1) ||
							(algo.employee_code.toLowerCase().indexOf(word.toLowerCase()) != -1)
						){
							that.employees_filtered = [algo]
						}
					})
				})
				this.searching_employee = false
			}
			else {
				that.employees_filtered = this.employees.data
			}


		},

		taxOption (option) {
			this.assign_compensation.tax = option
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
			this.axiosRequest ('GET', this.$store.state.comp + 'allowance?filter=all')
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

			// this.axiosRequest ('POST', this.$store.state.comp + 'allowance', this.compensation)
			// .then (res => {
			//
			// 	this.notif = res.data
			// 	this.tnotif (res)
			// 	this.create_assign_loading = false
			//
			// })
			// .catch (err => {
			// 	console.log(err)
			// 	this.create_assign_loading = false
			// })
		},

	}
}
</script>

<style lang="css" scoped>
</style>
