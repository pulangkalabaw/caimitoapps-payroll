<template lang="html">
	<div>
		<div v-if="!show_employee_loading">
			<div class="modal fade in" :class="{ 'show': !hide_compensation_modal_add }">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">
								<span class="fa fa-plus-circle"></span>
								Add new Compensation
							</h4>
						</div>
						<div class="modal-body">


						</div>
						<div class="modal-footer">

						</div>
					</div>
				</div>
			</div>

			<!-- List of compensations -->
			<div class="row">
				<div class="col-md-6">
					<h4>Compensation</h4>
				</div>
				<div class="col-md-6 text-right">
					<button class="btn btn-primary btn-sm btn-tunch" @click="hide_compensation_modal_add = true">
						<span class="fa fa-plus-circle"></span>
						Add
					</button>
				</div>
			</div>
			<ul>
				<li>
					<b>Taxable</b>
					<table class="table table-sm table-bordered" v-if="employee.user_compensation.length != 0">
						<thead>
							<tr>
								<th width="20%">Code</th>
								<th width="40%">Name</th>
								<th width="40%">Amount</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="uc in compensationTaxable">
								<td>SKL</td>
								<td>
									{{ ucfirst(uc.get_compensation.name) }}
								</td>
								<td>
									{{ uc.amount.toFixed(2) }}
								</td>
							</tr>
							<tr>
								<td></td> <td></td>
								<td>
									<b>Total Taxable:</b> {{ compensation_total(compensationTaxable) }}
								</td>
							</tr>
						</tbody>
					</table>
				</li>
				<li>
					<b>Non - Taxable</b>
					<table class="table table-sm table-bordered" v-if="employee.user_compensation.length != 0">
						<thead>
							<tr>
								<th width="20%">Code</th>
								<th width="40%">Name</th>
								<th width="40%">Amount</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="uc in compensationNonTaxable">
								<td>SKL</td>
								<td>
									{{ ucfirst(uc.get_compensation.name) }}
								</td>
								<td>
									{{ uc.amount.toFixed(2) }}
								</td>
							</tr>
							<tr>
								<td></td> <td></td>
								<td>
									<b>Total Non Taxable:</b> {{ compensation_total(compensationNonTaxable) }}
								</td>
							</tr>
						</tbody>
					</table>
				</li>
				<li>
					<table class="table table-sm table-bordered" v-if="employee.user_compensation.length != 0">
						<tbody>
							<tr>
								<td width="60%" class="text-center">
									<b>
										Total Compensation
									</b>
								</td>
								<td width="40%">
									<b>Total Compensation:</b> {{ compensation_total(employee.user_compensation) }}
								</td>
							</tr>
						</tbody>
					</table>
				</li>
			</ul>

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
			compensation: [],
			index_compensation_loading: true,
			create_ucompensation_loading: false,
			employee: {},
			show_employee_loading: true,

			notif: '',
			assign_compensation: {
				compensation_id: null,
				user_id: [],
				taxable: null,
			},

			// Modals
			hide_compensation_modal_add: false,
		}
	},
	created () {
		this.employeeShow()
		this.compensationIndex()
	},

	computed: {

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

			})
			.catch (err => {
				console.log(err)
				this.create_ucompensation_loading = false
			})

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
