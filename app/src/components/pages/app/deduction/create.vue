<template lang="html">
	<div class="">

		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

		<div id="content">
			<div class="card">
				<div class="card-header">
					<span class="fa fa-folder"></span>
					Create new Deduction
				</div>
				<div class="card-body">

					<notif :notif="notif"></notif>
					<div class="clearfix"></div>

					<form @submit.prevent="deductionCreate()" method="POST">

						<div class="row">
							<div class="col-md-2">Deduction Name <span class="required">*</span></div>
							<div class="col-md-4">
								<input type="text" v-model="deduction.name" class="form-control form-control-sm" required>
							</div>
						</div>
						<div class="clearfix"></div><br />

						<div class="row">
							<div class="col-md-2">Amount <span class="required">*</span></div>
							<div class="col-md-4">
								<input type="text" v-model="deduction.amount" class="form-control form-control-sm" required>
							</div>
						</div>
						<div class="clearfix"></div><br />

						<div class="row">
							<div class="col-md-2">Taxable <span class="required">*</span></div>
							<div class="col-md-4">
								<select v-model="deduction.taxable" class="form-control form-control-sm">
									<option value="bp">Before Payroll</option>
									<option value="ap">After Payroll</option>
								</select>
							</div>
						</div>
						<div class="clearfix"></div><br />


						<div class="row">
							<div class="col-md-4 offset-md-2 text-right">
								<button class="btn btn-success btn-sm" :disabled="create_deduction_loading">
									<span v-if="create_deduction_loading">
										Submiting..
										<span class="fa fa-cog" :class="{ 'fa-spin': create_deduction_loading }"></span>
									</span>
									<span v-else>
										Submit
										<span class="fa fa-cog" :class="{ 'fa-spin': create_deduction_loading }"></span>
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
			deduction: {},
			create_deduction_loading: false,
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

	methods: {

		deductionCreate () {
			this.create_deduction_loading = true
			this.axiosRequest ('POST', this.$store.state.deduc + 'deduction', this.deduction)
			.then (res => {

				this.notif = res.data
				this.tnotif (res)
				this.create_deduction_loading = false

			})
			.catch (err => {
				console.log(err)
				this.create_deduction_loading = false
			})
		},

	}
}
</script>

<style lang="css" scoped>
</style>
