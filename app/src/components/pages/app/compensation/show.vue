<template lang="html">
	<div class="">

		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

		<div id="content" v-if="!show_compensation_loading">
			<div class="card" :class="{ 'border-warning ': edit_mode }">
				<div class="card-header">
					<div class="row">
						<div class="col-md-6">
							<span class="fa fa-folder"></span>
							Compensation
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

					<form @submit.prevent="compensationUpdate()" method="POST">
					
						<div class="row">
							<div class="col-md-2">Compensation Name <span class="required">*</span></div>
							<div class="col-md-4">
								<input type="text" v-model="compensation.name" :disabled="!edit_mode" class="form-control form-control-sm" required>
							</div>
						</div>
						<div class="clearfix"></div><br />

						<div class="row">
							<div class="col-md-2">Amount <span class="required">*</span></div>
							<div class="col-md-4">
								<input type="text" v-model="compensation.amount" :disabled="!edit_mode" class="form-control form-control-sm" required>
							</div>
						</div>
						<div class="clearfix"></div><br />

						<div class="row">
							<div class="col-md-2">Taxable <span class="required">*</span></div>
							<div class="col-md-4">
								<select v-model="compensation.taxable" :disabled="!edit_mode" class="form-control form-control-sm">
									<option value="1">Yes</option>
									<option value="0">No</option>
								</select>
							</div>
						</div>
						<div class="clearfix"></div><br />


						<div class="row" v-if="edit_mode">
							<div class="col-md-4 offset-md-2 text-right">
								<button class="btn btn-success btn-sm" :disabled="update_compensation_loading">
									<span v-if="update_compensation_loading">
										Submiting..
										<span class="fa fa-cog" :class="{ 'fa-spin': update_compensation_loading }"></span>
									</span>
									<span v-else>
										Submit
										<span class="fa fa-cog" :class="{ 'fa-spin': update_compensation_loading }"></span>
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
			compensation: {},
			update_compensation_loading: false,
			show_compensation_loading: true,
			edit_mode: false,

			notif: '',

			links: [
				{
					'label': 'Compensation',
					'route': 'compensation.index',
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
		this.compensationShow()
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

		compensationShow () {

			this.show_compensation_loading = true
			this.axiosRequest ('GET', this.$store.state.comp + 'compensation/' + this.$route.params.id)
			.then (res => {

				this.compensation = res.data.data
				this.valid = res.data.status == 'success' ? true : false
				this.show_compensation_loading = false
			})
			.catch (err => {
				console.log(err)
				this.show_compensation_loading = false
			})
		},

		compensationUpdate () {

			this.update_compensation_loading = true
			this.compensation._method = "PUT"

			this.axiosRequest ('POST', this.$store.state.comp + 'compensation/' + this.$route.params.id, this.compensation)
			.then (res => {

				this.compensation = res.data.data
				this.notif = res.data
				this.tnotif (res)
				this.update_compensation_loading = false

			})
			.catch (err => {
				console.log(err)
				this.update_compensation_loading = false
			})
		},

	}
}
</script>

<style lang="css" scoped>
</style>
