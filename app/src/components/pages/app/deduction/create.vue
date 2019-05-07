<template lang="html">
	<div class="">

		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

		<div id="content">

			<!-- Sub Menus -->
			<span @click="redirect('deduction.index')" class="btn btn-default btn-sm btn-tunch-default">
				<span class="fa fa-th-list"></span>
				View all
			</span>
			<div class="clearfix"></div><br />

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
							<div class="col-md-2">Code <span class="required">*</span></div>
							<div class="col-md-4">
								<input type="text" v-model="deduction.code" class="form-control form-control-sm" required>
							</div>
						</div>
						<div class="clearfix"></div><br />


						<div class="row">
							<div class="col-md-2">Deduction Name <span class="required">*</span></div>
							<div class="col-md-4">
								<input type="text" v-model="deduction.name" class="form-control form-control-sm" required>
							</div>
						</div>
						<div class="clearfix"></div><br />

						<div class="row">
							<div class="col-md-2">Type <span class="required">*</span></div>
							<div class="col-md-4">
								<select v-model="deduction.deduct_type" class="form-control form-control-sm" required>
									<option value="fixed">Fixed</option>
									<option value="variable">Variable</option>
								</select>
							</div>
						</div>
						<div class="clearfix"></div><br />

						<div v-if="deduction.deduct_type == 'fixed'">
							<div class="row">
								<div class="col-md-2">Amount <span class="required">*</span></div>
								<div class="col-md-4">
									<input type="text" v-model="deduction.amount" class="form-control form-control-sm" required>
								</div>
							</div>
							<div class="clearfix"></div><br />
						</div>


						<div class="row">
							<div class="col-md-2">Taxable <span class="required">*</span></div>
							<div class="col-md-4">
								<label>
									<input type="radio" value="bt" name="tax" @click="taxOption('bt')">
									Before Tax
								</label>
								<label>
									<input type="radio" value="at" name="tax" @click="taxOption('at')">
									After Tax
								</label>
							</div>
						</div>
						<div class="clearfix"></div><br />

						<div class="row">
							<div class="col-md-2">Type <span class="required">*</span></div>
							<div class="col-md-4">
								<label>
									<input type="radio" value="cd" name="type" @click="typeOption('cd')">
									Company Deduction
								</label>
								<label>
									<input type="radio" value="gd" name="type" @click="typeOption('gd')">
									Government Deduction
								</label>
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
			deduction: {
				code: null,
				name: null,
				amount: 0,
				taxable: null,
				type: null,
			},
			create_deduction_loading: false,
			notif: '',

			links: [
				{
					'label': 'Deductions',
					'route': 'compensation.index',
					'params': {}
				}
			]
		}
	},

	methods: {

		taxOption (option) {
			this.deduction.taxable = option
		},

		typeOption (option) {
			this.deduction.type = option
		},

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
