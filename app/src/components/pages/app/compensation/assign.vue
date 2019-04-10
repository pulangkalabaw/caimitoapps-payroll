<template lang="html">
	<div class="">

		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

		<div id="content">
			<div class="card">
				<div class="card-header">
					<span class="fa fa-folder"></span>
					Assign Allowance
				</div>
				<div class="card-body">

					<notif :notif="notif"></notif>
					<div class="clearfix"></div>

					<form @submit.prevent="compensationCreate()" method="POST">
						{{ assign_compensation }}
						<div class="row">
							<div class="col-md-2">Select allowance <span class="required">*</span></div>
							<div class="col-md-4">
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
							<div class="col-md-2">Select employee(s) <span class="required">*</span></div>
							<div class="col-md-4">
								<span v-if="!index_employees_loading">

									<input type="text" v-model="search_employee" id="" @keyup="searchEmployee()"><br />
									<span v-for="employee in employees_filtered"  v-if="!searching_employee">
										<input :checked="assign_compensation.user_id.includes(employee.user_id)" type="checkbox" :id="employee.user_id" @click="appendEmployee(employee.user_id)">
										<label :for="employee.user_id">
											{{ employee.employee_code }}
											{{ employee.fname }}
											{{ employee.lname }}
										</label>
										&nbsp;
									</span>
								</span>
								<span v-else>
									fetching..

								</span>
							</div>
						</div>
						<div class="clearfix"></div><br />


						<div class="row">
							<div class="col-md-4 offset-md-2 text-right">
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
			searching_employee: false,

			compensation: [],
			index_compensation_loading: false,

			employees: [],
			employees_filtered: [],
			index_employees_loading: true,

			assign_compensation: {
				allowance_id: null,
				user_id: []
			},
			create_assign_loading: false,

			notif: '',
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
							// resultList.innerHTML += `<li class="list-group-item">${algo}</li>`;
							that.employees_filtered = [algo]
							console.log(algo)
						}
					})
				})
				this.searching_employee = false
			}
			else {
				that.employees_filtered = this.employees.data
			}

		},

		appendEmployee (id) {
			if (this.assign_compensation.user_id.includes(id)) {
				this.assign_compensation.user_id.pop(id)
			}
			else {
				this.assign_compensation.user_id.push(id)
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

		compensationCreate () {
			this.create_assign_loading = true
			this.axiosRequest ('POST', this.$store.state.comp + 'allowance', this.compensation)
			.then (res => {

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
