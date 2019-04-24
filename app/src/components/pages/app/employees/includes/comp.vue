<template lang="html">
	<div>
		<div v-if="!show_employee_loading">

			<!-- List of compensations -->
			<small>
				<b>
					Compensation
					({{ employee.user_compensation != null ? employee.user_compensation.length : 0 }})
				</b>
			</small>
			<table class="table table-sm table-bordered" v-if="employee.user_compensation.length != 0">
				<thead>
					<tr>
						<th>Code</th>
						<th>Name</th>
						<th>Tax</th>
						<th>Date Start</th>
						<th>Type</th>
						<th>Amount</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="uc in employee.user_compensation">
						<td>SKL</td>
						<td>
							{{ ucfirst(uc.get_compensation.name) }}
						</td>
						<td>
							{{ uc.get_compensation.taxable ? 'Taxable' : 'Non-Taxable' }}
						</td>
						<td>
							{{ $moment(uc.created_at).format('YYYY-MM-DD') }}
						</td>
						<td>
							{{ ucfirst(uc.type) }}
						</td>
						<td>
							{{ uc.amount.toFixed(2) }}
						</td>
					</tr>
					<tr> <td>&nbsp;</td> <td></td> <td></td> <td></td> <td></td> <td></td> </tr>
					<tr>
						<td></td> <td></td> <td></td> <td></td> <td></td>
						<td>
							<b>Total:</b> {{ compensation_total }}
						</td>
					</tr>
				</tbody>
			</table>

			<!-- List of compensations -->
			<small>
				<b>
					Deduction
					({{ employee.user_compensation != null ? employee.user_compensation.length : 0 }})
				</b>
			</small>
			<table class="table table-sm table-bordered" v-if="employee.user_compensation.length != 0">
				<thead>
					<tr>
						<th>Code</th>
						<th>Name</th>
						<th>Tax</th>
						<th>Date Start</th>
						<th>Amount</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="uc in employee.user_compensation">
						<td>SKL</td>
						<td>
							{{ ucfirst(uc.get_compensation.name) }}
						</td>
						<td>
							{{ uc.get_compensation.taxable ? 'Taxable' : 'Non-Taxable' }}
						</td>
						<td>
							{{ $moment(uc.created_at).format('YYYY-MM-DD') }}
						</td>
						<td>
							{{ uc.amount.toFixed(2) }}
						</td>
					</tr>
					<tr> <td>&nbsp;</td> <td></td> <td></td> <td></td> <td></td> </tr>
					<tr>
						<td></td> <td></td> <td></td> <td></td>
						<td>
							<b>Total:</b> {{ compensation_total }}
						</td>
					</tr>
				</tbody>
			</table>


			<!-- <table class="table" v-if="employee.user_compensation.length != 0">
				<tbody>
					<tr>
						<td>
							<div v-if="employee.user_compensation">
								<ul class="list-group">
									<li class="list-group-item span-link" v-for="uc in employee.user_compensation">
										<label>
											Allowance: {{ ucfirst(uc.get_compensation.name) }} <br />
											Amount: {{ uc.amount }} <br />
											Taxable: {{ uc.get_compensation.taxable ? 'Taxable' : 'Non-Taxable' }} <br />
											Date start: {{ uc.created_at }} <br />
											<span class="span-link" @click="removeCompensation(uc.id)">
												<span class="fa fa-times"></span>
												Remove
											</span>
										</label>
									</li>
								</ul>
							</div>
						</td>
					</tr>
				</tbody>
			</table> -->
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
		}
	},
	created () {
		this.employeeShow()
		this.compensationIndex()
	},

	computed: {
		compensation_total() {
			if (this.employee.user_compensation) {
				var total = 0;
				this.employee.user_compensation.map (function (uc) {
					if (uc.amount != 0 || !uc.amount) {
						total += uc.amount
					}
				})
				return total.toFixed(2);
			}

			return 0;
		}
	},

	methods: {

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

		taxOption (option) {
			this.assign_compensation.taxable = option
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
</style>
