<template lang="html">
	<div>
		<small>
			<b>Add Compensation</b>
		</small>
		<div v-if="!show_employee_loading">
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


						<!-- Taxable -->
						<tr v-if="!index_compensation_loading">
							<td>
								Taxable:
							</td>
							<td>
								<label>
									<input type="radio" value="nt" name="tax" @click="taxOption(0)" required>
									Non-Taxable
								</label>
								<label>
									<input type="radio" value="t" name="tax" @click="taxOption(1)" required>
									Taxable
								</label>
							</td>
						</tr>

						<!-- Taxable -->
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
			<br />

			<!-- List of compensations -->
			<small>
				<b>
					Current Compensation
					({{ employee.user_compensation != null ? employee.user_compensation.length : 0 }})
				</b>
			</small>
			<table class="table" v-if="employee.user_compensation.length != 0">
				<tbody>
					<tr>
						<td>
							<div v-if="employee.user_compensation">
								<ul class="list-group">
									<li class="list-group-item span-link" v-for="uc in employee.user_compensation">
										<label>
											Allowance: {{ ucfirst(uc.get_compensation.name) }} <br />
											Amount: {{ uc.amount }} <br />
											Taxable: {{ uc.taxable ? 'Taxable' : 'Non-Taxable' }} <br />
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
			</table>
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
