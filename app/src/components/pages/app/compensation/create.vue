<template lang="html">
	<div class="">

		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

		<div id="content">

			<!-- Sub Menus -->
			<span @click="redirect('compensation.index')" class="btn btn-default btn-sm btn-tunch-default">
				<span class="fa fa-th-list"></span>
				View all
			</span>
			<div class="clearfix"></div><br />

			<div class="card">
				<div class="card-header">
					<span class="fa fa-folder"></span>
					Create new Compensation
				</div>
				<div class="card-body">

					<notif :notif="notif"></notif>
					<div class="clearfix"></div>

					<form @submit.prevent="compensationCreate()" method="POST">

						<div class="row">
							<div class="col-md-2">Compensation Name <span class="required">*</span></div>
							<div class="col-md-4">
								<input type="text" v-model="compensation.name" class="form-control form-control-sm" required>
							</div>
						</div>
						<div class="clearfix"></div><br />

						<div class="row">
							<div class="col-md-2">Amount <span class="required">*</span></div>
							<div class="col-md-4">
								<input type="text" v-model="compensation.amount" class="form-control form-control-sm" required>
							</div>
						</div>
						<div class="clearfix"></div><br />

						<div class="row">
							<div class="col-md-2">Taxable <span class="required">*</span></div>
							<div class="col-md-4">
								<select v-model="compensation.taxable" class="form-control form-control-sm">
									<option value="1">Yes</option>
									<option value="0">No</option>
								</select>
							</div>
						</div>
						<div class="clearfix"></div><br />


						<div class="row">
							<div class="col-md-4 offset-md-2 text-right">
								<button class="btn btn-success btn-sm" :disabled="create_compensation_loading">
									<span v-if="create_compensation_loading">
										Submiting..
										<span class="fa fa-cog" :class="{ 'fa-spin': create_compensation_loading }"></span>
									</span>
									<span v-else>
										Submit
										<span class="fa fa-cog" :class="{ 'fa-spin': create_compensation_loading }"></span>
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
			create_compensation_loading: false,
			notif: '',

			links: [
				{
					'label': 'Compensation',
					'route': 'compensation.index',
					'params': {}
				}
			]
		}
	},

	methods: {

		compensationCreate () {
			this.create_compensation_loading = true
			this.axiosRequest ('POST', this.$store.state.comp + 'compensation', this.compensation)
			.then (res => {

				this.notif = res.data
				this.tnotif (res)
				this.create_compensation_loading = false

			})
			.catch (err => {
				console.log(err)
				this.create_compensation_loading = false
			})
		},

	}
}
</script>

<style lang="css" scoped>
</style>
