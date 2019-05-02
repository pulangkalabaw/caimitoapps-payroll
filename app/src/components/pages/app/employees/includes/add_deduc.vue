<template lang="html">
	<div>
		<small>
			<b>Add Deduction</b>
		</small>
		<div v-if="!show_employee_loading">
			<form @submit.prevent="addCompensation()" method="POST">

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

						<tr>
							<td>Date Start <span class="required">*</span></td>
							<td>
								<input type="date" v-model="assign_deduc.date_start" id="" class="form-control form-control-sm" required>
							</td>
						</tr>


						<tr>
							<td>Date End <span class="required">*</span></td>
							<td>
								<input type="date" v-model="assign_deduc.date_end" id="" class="form-control form-control-sm" required>
							</td>
						</tr>


						<!-- Taxable -->
						<tr>
							<td></td>
							<td class="text-right">
								<button class="btn btn-success btn-sm" :disabled="create_udeduc_loading">
									<span v-if="create_udeduc_loading">
										Submiting..
										<span class="fa fa-cog" :class="{ 'fa-spin': create_udeduc_loading }"></span>
									</span>
									<span v-else>
										Submit
										<span class="fa fa-cog" :class="{ 'fa-spin': create_udeduc_loading }"></span>
									</span>
								</button>
							</td>
						</tr>

					</tbody>
				</table>
			</form>
			<br />

			<!-- List of compensations -->
			<!-- {{ employee }} -->
			<small>
				<b>
					Current Compensation
					({{ employee.user_deduction != null ? employee.user_deduction.length : 0 }})
				</b>
			</small>
			<table class="table" v-if="employee.user_deduction.length != 0">
				<tbody>
					<tr>
						<td>
							<div v-if="employee.user_deduction">
								<ul class="list-group">
									<li class="list-group-item span-link" v-for="uc in employee.user_deduction">
										<label>
											Allowance: {{ ucfirst(uc.get_deduction.name) }} <br />
											Amount: {{ uc.amount }} <br />
											Taxable: {{ uc.get_deduction.taxable  == 'at' ? 'After Tax' : 'Before Tax' }} <br />
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
			deduction: [],
			index_deduc_loading: true,
			create_udeduc_loading: false,
			employee: {},
			show_employee_loading: true,

			notif: '',
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
	},

	methods: {

		removeCompensation (id) {

			let params = {
				_method: 'DELETE',
				ud_id: id,
			}
			this.axiosRequest ('POST', this.$store.state.deduc + 'assign-deduction/' + this.$route.params.id + '/delete', params)
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

			this.assign_deduc.user_id = []
			this.assign_deduc.user_id.push(this.$route.params.id)

			this.create_udeduc_loading = true
			this.axiosRequest ('POST', this.$store.state.deduc + 'assign-deduction', this.assign_deduc)
			.then (res => {
				this.notif = res.data
				this.tnotif (res)
				this.create_udeduc_loading = false
				this.employeeShow()
			})
			.catch (err => {
				console.log(err)
				this.create_udeduc_loading = false
			})
		},

		taxOption (option) {
			this.assign_deduc.taxable = option
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
	}
}
</script>

<style lang="css" scoped>
</style>
