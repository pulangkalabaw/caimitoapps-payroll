<template lang="html">
	<div>
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add new compensation</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form @submit.prevent="addCompensation()" method="POST">

							<notif :notif="notif"></notif>
							<div class="clearfix"></div>

							<table class="table">
								<tbody>
									<!-- Add new Allowance -->
									<tr v-if="!index_compensation_loading">
										<td width="30%">
											Select Compensation:
										</td>
										<td>
											<select v-model="assign_compensation.compensation_id" class="form-control form-control-sm" required>
												<option :value="comp.compensation_id" v-for="comp in compensation.data">
													{{ comp.name }}
												</option>
											</select>
										</td>
									</tr>

									<tr v-else>
										<td>fetching</td>
									</tr>

									<tr v-if="assign_compensation.compensation_id != null && compensation.data.filter(x => x.compensation_id == assign_compensation.compensation_id)[0].type == 'variable'">
										<td>Amount <span class="required">*</span></td>
										<td>
											<input type="text" v-model="assign_compensation.amount" id="" class="form-control form-control-sm" required>
											<small>
												<span class="fa fa-info-circle"></span>
												this compensation is a variable, amount field is required <span class="required">*</span>
											</small>
										</td>
									</tr>

									<tr>
										<td>Date Start <span class="required">*</span></td>
										<td>
											<input type="date" v-model="assign_compensation.date_start" id="" class="form-control form-control-sm" required>
										</td>
									</tr>

									<tr>
										<td></td>
										<td class="text-right">
											<button class="btn btn-success btn-sm" :disabled="create_ucompensation_loading">
												<span v-if="create_ucompensation_loading">
													Submiting..
													<span class="fa fa-cog" :class="{ 'fa-spin': create_ucompensation_loading }"></span>
												</span>
												<span v-else>
													Submit
													<span class="fa fa-cog" :class="{ 'fa-spin': create_ucompensation_loading }"></span>
												</span>
											</button>
										</td>
									</tr>

								</tbody>
							</table>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="deduction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add new deduction</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form @submit.prevent="addDeduction()" method="POST">

							<notif :notif="notif"></notif>
							<div class="clearfix"></div>


							<table class="table">
								<tbody>
									<!-- Add new Allowance -->
									<tr v-if="!index_deduc_loading">
										<td width="30%">
											Select Deduction:
										</td>
										<td>
											<select v-model="assign_deduc.deduction_id" class="form-control form-control-sm" required>
												<option :value="dd.deduction_id" v-for="dd in deduction.data">
													{{ dd.name }}
												</option>
											</select>
										</td>
									</tr>
									<tr v-else>
										<td>fetching</td>
									</tr>

									<tr v-if="assign_deduc.deduction_id != null && deduction.data.filter(x => x.deduction_id == assign_deduc.deduction_id)[0].deduct_type == 'variable'">
										<td>Amount <span class="required">*</span></td>
										<td>
											<input type="text" v-model="assign_deduc.amount" id="" class="form-control form-control-sm" required>
											<small>
												<span class="fa fa-info-circle"></span>
												this deduction is a variable, amount field is required <span class="required">*</span>
											</small>
										</td>
									</tr>

									<tr>
										<td>Date Start <span class="required">*</span></td>
										<td>
											<input type="date" v-model="assign_deduc.date_start" id="" class="form-control form-control-sm" required>
										</td>
									</tr>


									<tr>
										<td>Date End</td>
										<td>
											<input type="date" v-model="assign_deduc.date_end" id="" class="form-control form-control-sm">
										</td>
									</tr>


									<!-- Taxable -->
									<tr>
										<td></td>
										<td class="text-right">
											<button class="btn btn-success btn-sm" :disabled="create_deduc_loading">
												<span v-if="create_deduc_loading">
													Submiting..
													<span class="fa fa-cog" :class="{ 'fa-spin': create_deduc_loading }"></span>
												</span>
												<span v-else>
													Submit
													<span class="fa fa-cog" :class="{ 'fa-spin': create_deduc_loading }"></span>
												</span>
											</button>
										</td>
									</tr>

								</tbody>
							</table>
						</form>
						<br />
					</div>
				</div>
			</div>
		</div>


		<div class="modal fade" id="compensation_modify" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" v-if="compensation_line">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">
							Edit:

						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						{{ compensation_line }}

						<table class="table table-sm table-bordered">
							<thead>
								<tr>
									<th width="20%">Code</th>
									<th width="40%">Name</th>
									<th width="40%">Amount</th>
								</tr>
							</thead>
							<tbody v-if="compensation_line != null">
								<tr>
									<td>
										{{ compensation_line.get_compensation ? compensation_line.get_compensation.code : '-'}}
									</td>
									<td>
										{{ compensation_line.get_compensation ? ucfirst(compensation_line.get_compensation.name) : '-'}}
									</td>
									<td>
										<input type="text" v-model="compensation_line.amount" id="" class="form-control">
									</td>
								</tr>
							</tbody>
						</table>
						<div class="clearfix"></div><br>

						<div class="row">
							<div class="col-md-12">
								<button @click="compensationSoftAmountChange(compensation.compensation_id)" class="btn btn-success btn-xs">
									Submit
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div v-if="!show_employee_loading">

			<!-- List of compensations -->
			<div>
				<div class="row">
					<div class="col-md-6">
						<h5>Compensation</h5>
					</div>
					<div class="col-md-6 text-right">
						<button class="btn btn-primary btn-sm btn-tunch" data-toggle="modal" data-target="#exampleModal">
							<span class="fa fa-plus-circle"></span>
							Add
						</button>
					</div>
				</div>
				<ul>
					<li v-if="compensationTaxable.length != 0">
						<b>Taxable</b>
						<table class="table table-sm table-bordered">
							<thead>
								<tr>
									<th width="20%">Code</th>
									<th width="40%">Name</th>
									<th width="40%">Amount</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="uc in compensationTaxable">
									<td v-if="uc.get_compensation.type =='variable'">
										<span class="fa fa-edit" @click="compensation_line_change(uc.compensation_id)"></span>
										{{ uc.get_compensation.code.toUpperCase() }}
									</td>
									<td>
										{{ ucfirst(uc.get_compensation.name) }}
									</td>
									<td>
										{{ number_format(uc.amount) }}
									</td>
								</tr>
								<tr>
									<td></td> <td></td>
									<td>
										<b>Total Taxable:</b> {{ number_format(compensation_total(compensationTaxable)) }}
									</td>
								</tr>
							</tbody>
						</table>
					</li>
					<li v-if="compensationNonTaxable.length != 0">
						<b>Non - Taxable</b>
						<table class="table table-sm table-bordered">
							<thead>
								<tr>
									<th width="20%">Code</th>
									<th width="40%">Name</th>
									<th width="40%">Amount</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="uc in compensationNonTaxable">
									<td v-if="uc.get_compensation.type =='variable'">
										<span class="fa fa-edit" @click="compensation_line_change(uc.get_compensation.compensation_id)"></span>
										{{ uc.get_compensation.code.toUpperCase() }}
									</td>
									<td>
										{{ ucfirst(uc.get_compensation.name) }}
									</td>
									<td>
										{{ number_format(uc.amount) }}
									</td>
								</tr>
								<tr>
									<td></td> <td></td>
									<td>
										<b>Total Non Taxable:</b> {{ number_format(compensation_total(compensationNonTaxable)) }}
									</td>
								</tr>
							</tbody>
						</table>
					</li>
					<li>
						<table class="table table-sm table-bordered" v-if="employee.user_compensation.length != 0">
							<tbody>
								<tr class="table-success">
									<td width="60%" class="text-center">
										<b>
											Total Compensation
										</b>
									</td>
									<td width="40%">
										<b>Total Compensation: (+) {{ number_format(compensation_total(employee.user_compensation)) }}</b>
									</td>
								</tr>
							</tbody>
						</table>
					</li>
				</ul>
			</div>
			<div class="clearfix"></div>
			<hr>

			<!-- List of deduction -->
			<div>
				<div class="row">
					<div class="col-md-6">
						<h5>Deduction</h5>
					</div>
					<div class="col-md-6 text-right">
						<button class="btn btn-primary btn-sm btn-tunch" data-toggle="modal" data-target="#deduction">
							<span class="fa fa-plus-circle"></span>
							Add
						</button>
					</div>
				</div>
				<ul>
					<li v-if="deductionCompany.length != 0">
						<b>Company Deduction</b>
						<table class="table table-sm table-bordered">
							<thead>
								<tr>
									<th width="20%">Code</th>
									<th width="40%">Name</th>
									<th width="40%">Amount</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="dc in deductionCompany">
									<td>{{ dc.get_deduction.code ? dc.get_deduction.code : '-' }}</td>
									<td>
										{{ ucfirst(dc.get_deduction.name) }}
									</td>
									<td>
										{{ number_format(dc.amount) }}
									</td>
								</tr>
							</tbody>
						</table>
					</li>
					<li v-if="deductionGovernment.length != 0">
						<b>Government Deduction</b>
						<table class="table table-sm table-bordered">
							<thead>
								<tr>
									<th width="20%">Code</th>
									<th width="40%">Name</th>
									<th width="40%">Amount</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="dg in deductionGovernment">
									<td>{{ dg.get_deduction.code ? dg.get_deduction.code : '-' }}</td>
									<td>
										{{ ucfirst(dg.get_deduction.name) }}
									</td>
									<td>
										{{ number_format(dg.amount) }}
									</td>
								</tr>
							</tbody>
						</table>
					</li>
					<li>
						<table class="table table-sm table-bordered" v-if="employee.user_deduction.length != 0">
							<tbody>
								<tr class="table-danger">
									<td width="60%" class="text-center">
										<b>
											Total Deductions
										</b>
									</td>
									<td width="40%">
										<b>Total Deductions: (-) {{ number_format(deduction_total(employee.user_deduction)) }}</b>
									</td>
								</tr>
							</tbody>
						</table>
					</li>
				</ul>
			</div>

			<div class="clearfix"></div>
			<hr>

			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered">
						<tbody>
							<tr class="table-primary">

								<td class="text-right">
									<b>
										Estimated Net Pay
									</b>
								</td>
								<td>
									<b>{{ number_format(estNetPay) }}</b>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

		</div>
		<div v-else>
			fetching..
		</div>
	</div>
</template>

<script>
export default {
	data () {
		return {
			notif: '',
			employee: {},
			show_employee_loading: true,


			/**
			* Compensation Data
			* @type {Array}
			*/
			compensation: [],
			index_compensation_loading: true,
			create_ucompensation_loading: false,
			assign_compensation: {
				compensation_id: null,
				user_id: [],
				taxable: null,
			},

			compensation_line: {},

			/**
			* Deduction Data
			* @type {Array}
			*/

			deduction: [],
			index_deduc_loading: true,
			create_deduc_loading: false,
			assign_deduc: {
				deduction_id: null,
				user_id: [],
				taxable: null,
			},
		}
	},
	created () {
		this.employeeShow()
		this.deductionIndex()
		this.compensationIndex()
	},

	computed: {

		// EST. NET PAY
		estNetPay () {
			let total = this.compensation_total(this.employee.user_compensation) - this.deduction_total(this.employee.user_deduction)
			return total.toFixed(2)
		},

		// deductionCompany
		deductionCompany () {
			if (this.employee.user_deduction) {
				var total = 0;
				let taxable = this.employee.user_deduction.filter(function(r){
					return r.get_deduction.type == 'gd'
				})
				return taxable
			}
			return this.employee.user_deduction;
		},

		// deductionGovernment
		deductionGovernment () {
			if (this.employee.user_deduction) {
				var total = 0;
				let taxable = this.employee.user_deduction.filter(function(r){
					return r.get_deduction.type == 'cd'
				})
				return taxable
			}
			return this.employee.user_deduction;
		},

		// CompensationTaxable
		compensationTaxable () {
			if (this.employee.user_compensation) {
				var total = 0;
				let taxable = this.employee.user_compensation.filter(function(r){
					return r.get_compensation.taxable == 1 || r.get_compensation.taxable
				})
				return taxable
			}
			return this.employee.user_compensation;
		},

		// CompensationNon-Taxable
		compensationNonTaxable () {
			if (this.employee.user_compensation) {
				var total = 0;
				let nontaxable = this.employee.user_compensation.filter(function(r){
					return r.get_compensation.taxable == 0 || !r.get_compensation.taxable
				})
				return nontaxable
			}
			return this.employee.user_compensation;
		},

	},

	methods: {

		compensationSoftAmountChange (id) {
			this.employee.user_compensation.filter(x => x.compensation_id == id)[0].amount = this.compensation_line.amount
		},

		compensation_line_change (id) {

			$("#compensation_modify").modal('show')
			console.log(this.employee.user_compensation.filter(x => x.compensation_id == id)[0])
			this.compensation_line = this.employee.user_compensation.filter(x => x.compensation_id == id)[0];
			// this.compensation_line = this.employee.data.filter(x => x.compensation_id == id)[0];
		},

		employeeShow () {

			this.show_employee_loading = true
			this.axiosRequest ('GET', this.$store.state.pis + 'employee/' + this.$route.params.id)
			.then (res => {

				this.employee = res.data.data.data
				this.show_employee_loading = false
				this.valid = res.data.status == 'success' ? true : false

			})
			.catch (err => {
				console.log(err)
				this.show_employee_loading = false
			})

		},

		/**
		* Deduction Methods
		* @type {Number}
		*/

		deduction_total(arr) {
			if (arr) {
				var total = 0;
				arr.map (function (ud) {
					if (ud.amount != 0 || !ud.amount) {
						total += ud.amount
					}
				})
				return total.toFixed(2);
			}

			return 0;
		},

		addDeduction () {

			this.assign_deduc.user_id = []
			this.assign_deduc.user_id.push(this.$route.params.id)

			this.create_deduc_loading = true
			this.axiosRequest ('POST', this.$store.state.deduc + 'assign-deduction', this.assign_deduc)
			.then (res => {
				this.notif = res.data
				this.tnotif (res)
				this.create_deduc_loading = false
				this.employeeShow()
			})
			.catch (err => {
				console.log(err)
				this.create_deduc_loading = false
			})
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


		/**
		* Compensation Methods
		* @param  {[type]} arr [description]
		* @return {[type]}     [description]
		*/
		compensation_total(arr) {
			if (arr) {
				var total = 0;
				arr.map (function (uc) {
					if (uc.amount != 0 || !uc.amount) {
						total += uc.amount
					}
				})
				return total.toFixed(2);
			}

			return 0;
		},

		removeCompensation (id) {

			let params = {
				_method: 'DELETE',
				uc_id: id,
			}
			this.axiosRequest ('POST', this.$store.state.comp + 'assign-compensation/' + this.$route.params.id + '/delete', params)
			.then (res => {

				this.notif = res.data
				this.tnotif (res)
				this.employeeShow()

			})
			.catch (err => {
				console.log(err)
			})
		},

		addCompensation () {

			this.assign_compensation.user_id = []
			this.assign_compensation.user_id.push(this.$route.params.id)

			this.create_ucompensation_loading = true
			this.axiosRequest ('POST', this.$store.state.comp + 'assign-compensation', this.assign_compensation)
			.then (res => {

				this.notif = res.data
				this.tnotif (res)
				this.create_ucompensation_loading = false
				this.employeeShow()
			})
			.catch (err => {
				console.log(err)
				this.create_ucompensation_loading = false
			})

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
	}
}
</script>

<style lang="css" scoped>
ul {
	list-style: none;
}
</style>
