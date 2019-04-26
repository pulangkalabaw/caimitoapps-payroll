<template lang="html">
	<div class="">
		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />
		<div id="content">

			<!-- Sub Menus -->
			<span @click="redirect('government.tax.index')" class="btn btn-default btn-sm btn-tunch-default">
				<span class="fa fa-th-list"></span>
				View all
			</span>	
			<div class="clearfix"></div><br />

			<div class="card">
				<div class="card-header">
					<span class="fa fa-folder"></span>
					Create new sss deduction
				</div>
				<div class="card-body">
					<notif :notif="notif"></notif>
					<div class="clearfix"></div>

					<form  @submit.prevent="TaxCreate()" method="POST">
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-12">Wage type <span class="required">*</span></div>
									<div class="col-md-12">
										<input type="text"  v-model="tax.wage_type" class="form-control form-control-sm" required>
									</div>
								</div>
								<div class="clearfix"></div><br />

								<div class="row">
									<div class="col-md-12">Compensation range from <span class="required">*</span></div>
									<div class="col-md-12">
										<input type="text" v-model="tax.compensation_range_from" class="form-control form-control-sm" required>
									</div>
								</div>
								<div class="clearfix"></div><br />

								<div class="row">
									<div class="col-md-12">Compensation range from <span class="required">*</span></div>
									<div class="col-md-12">
										<input type="text" v-model="tax.compensation_range_to" class="form-control form-control-sm" required>
									</div>
								</div>
								<div class="clearfix"></div><br />

								<div class="row">
									<div class="col-md-12">Prescribed with holding tax <span class="required">*</span></div>
									<div class="col-md-12">
										<input type="text" v-model="tax.prescribed_withholding_tax" class="form-control form-control-sm" required>
									</div>
								</div>
								<div class="clearfix"></div><br />

								<div class="row">
									<div class="col-md-12 text-right">
										<button class="btn btn-success btn-sm text-right">Submit</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

</template>

<script>
	export default{
		data(){
			return{
				tax: {},
				notif: '',
				links: [
					{
						'label': 'Tax',
						'route': 'government.tax.create',
						'params': {}
					}
				]
			}
		},

		methods: {
			TaxCreate(){
				this.axiosRequest ('POST', this.$store.state.deduc + 'tax-deductions/store', this.tax)
				.then(res => {
					console.log(res.data.data)
				})
				.catch(err => {
					console.log(err)
				})
			},
		}
	}


</script>



<style>
	

</style>