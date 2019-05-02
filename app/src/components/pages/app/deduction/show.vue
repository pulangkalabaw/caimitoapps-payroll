<template lang="html">
	<div class="">

		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

		<div id="content" v-if="!show_deduc_loading">
			<div class="card" :class="{ 'border-warning ': edit_mode }">
				<div class="card-header">
					<div class="row">
						<div class="col-md-6">
							<span class="fa fa-folder"></span>
							Deduction
						</div>
						<div class="col-md-6 text-right">
							<button v-if="!edit_mode" @click="editMode(true)" class="btn btn-warning btn-sm">
								<span class="fa fa-warning"></span>
								Go to Edit mode
							</button>
							<button v-else @click="editMode(false)" class="btn btn-sm btn-default">
								<span class="fa fa-times-circle"></span>
								Exit Edit mode
							</button>
						</div>
					</div>
				</div>
				<div class="card-body">

					<notif :notif="notif"></notif>
					<div class="clearfix"></div>

					<form @submit.prevent="deducUpdate()" method="POST">

						<div class="row">
							<div class="col-md-2">Code <span class="required">*</span></div>
							<div class="col-md-4">
								<input type="text" v-model="deduc.code" :disabled="!edit_mode" class="form-control form-control-sm" required>
							</div>
						</div>
						<div class="clearfix"></div><br />

						<div class="row">
							<div class="col-md-2">Deduction Name <span class="required">*</span></div>
							<div class="col-md-4">
								<input type="text" v-model="deduc.name" :disabled="!edit_mode" class="form-control form-control-sm" required>
							</div>
						</div>
						<div class="clearfix"></div><br />

						<div class="row">
							<div class="col-md-2">Amount <span class="required">*</span></div>
							<div class="col-md-4">
								<input type="text" v-model="deduc.amount" :disabled="!edit_mode" class="form-control form-control-sm" required>
							</div>
						</div>
						<div class="clearfix"></div><br />

						<div class="row">
							<div class="col-md-2">Taxable <span class="required">*</span></div>
							<div class="col-md-4">
								<label>
									<input type="radio" value="bt" :disabled="!edit_mode" name="tax" :checked="deduc.taxable == 'bt'" @click="taxOption('bt')">
									Before Tax
								</label>
								<label>
									<input type="radio" value="at" :disabled="!edit_mode" name="tax" :checked="deduc.taxable == 'at'" @click="taxOption('at')">
									After Tax
								</label>
							</div>
						</div>
						<div class="clearfix"></div><br />


						<div class="row" v-if="edit_mode">
							<div class="col-md-4 offset-md-2 text-right">
								<button class="btn btn-success btn-sm" :disabled="update_deduc_loading">
									<span v-if="update_deduc_loading">
										Submiting..
										<span class="fa fa-cog" :class="{ 'fa-spin': update_deduc_loading }"></span>
									</span>
									<span v-else>
										Submit
										<span class="fa fa-cog" :class="{ 'fa-spin': update_deduc_loading }"></span>
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
			deduc: {},
			update_deduc_loading: false,
			show_deduc_loading: true,
			edit_mode: false,

			notif: '',

			links: [
				{
					'label': 'Deductions',
					'route': 'deduction.index',
					'params': {}
				},
				{
					'label': 'View',
					'route': '',
					'params': {}
				}
			]
		}
	},

	created () {
		this.deducShow()
	},

	methods: {

		editMode (des){
			this.edit_mode = des
			if (des == true) {
				this.$notify({
					group: 'notif',
					title: 'Employee',
					text: 'You are in Edit Mode',
					type: 'warn',
				});
			}
			else {
				this.$notify({
					group: 'notif',
					title: 'Employee',
					text: 'You are in View Mode',
					type: 'info',
				});
			}
		},

		taxOption (option) {
			this.deduc.taxable = option
		},

		deducShow () {

			this.show_deduc_loading = true
			this.axiosRequest ('GET', this.$store.state.deduc + 'deduction/' + this.$route.params.id)
			.then (res => {

				this.deduc = res.data.data.data
				this.valid = res.data.status == 'success' ? true : false
				this.show_deduc_loading = false
			})
			.catch (err => {
				console.log(err)
				this.show_deduc_loading = false
			})
		},

		deducUpdate () {

			this.update_deduc_loading = true
			this.deduc._method = "PUT"

			this.axiosRequest ('POST', this.$store.state.deduc + 'deduction/' + this.$route.params.id, this.deduc)
			.then (res => {

				this.deduc = res.data.data
				this.notif = res.data
				this.tnotif (res)
				this.update_deduc_loading = false

			})
			.catch (err => {
				console.log(err)
				this.update_deduc_loading = false
			})
		},

	}
}
</script>

<style lang="css" scoped>
</style>
