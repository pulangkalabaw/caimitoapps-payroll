<template lang="html">
	<div class="">
		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />
		<div id="content">

			<!-- Sub Menus -->
			<span @click="redirect('government.sss.index')" class="btn btn-default btn-sm btn-tunch-default">
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

					<form  @submit.prevent="sssCreate()" method="POST">
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-12">From <span class="required">*</span></div>
									<div class="col-md-12">
										<input type="text"  v-model="sss.from" class="form-control form-control-sm" required>
									</div>
								</div>
								<div class="clearfix"></div><br />

								<div class="row">
									<div class="col-md-12">To <span class="required">*</span></div>
									<div class="col-md-12">
										<input type="text" v-model="sss.to" class="form-control form-control-sm" required>
									</div>
								</div>
								<div class="clearfix"></div><br />

								<div class="row">
									<div class="col-md-12">Monthly salary credit <span class="required">*</span></div>
									<div class="col-md-12">
										<input type="text" v-model="sss.monthly_salary_credit" class="form-control form-control-sm" required>
									</div>
								</div>
								<div class="clearfix"></div><br />

								<div class="row">
									<div class="col-md-12">Social security er <span class="required">*</span></div>
									<div class="col-md-12">
										<input type="text" v-model="sss.social_security_er" class="form-control form-control-sm" required>
									</div>
								</div>
								<div class="clearfix"></div><br />

								<div class="row">
									<div class="col-md-12">Social security ee <span class="required">*</span></div>
									<div class="col-md-12">
										<input type="text" v-model="sss.social_security_ee" class="form-control form-control-sm" required>
									</div>
								</div>
								<div class="clearfix"></div><br />
							</div>
							
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-12">Social security total <span class="required">*</span></div>
									<div class="col-md-12">
										<input type="text" v-model="sss.social_security_total" class="form-control form-control-sm" required>
									</div>
								</div>
								<div class="clearfix"></div><br />

								<div class="row">
									<div class="col-md-12">Ecr <span class="required">*</span></div>
									<div class="col-md-12">
										<input type="text" v-model="sss.ec_er"  class="form-control form-control-sm" required>
									</div>
								</div>
								<div class="clearfix"></div><br />

								<div class="row">
									<div class="col-md-12">Total contribution er <span class="required">*</span></div>
									<div class="col-md-12">
										<input type="text" v-model="sss.total_contribution_er" class="form-control form-control-sm" required>
									</div>
								</div>
								<div class="clearfix"></div><br />

								<div class="row">
									<div class="col-md-12">Total contribution ee <span class="required">*</span></div>
									<div class="col-md-12">
										<input type="text" v-model="sss.total_contribution_ee" class="form-control form-control-sm" required>
									</div>
								</div>
								<div class="clearfix"></div><br />

								<div class="row">
									<div class="col-md-12">Total contribution total <span class="required">*</span></div>
									<div class="col-md-12">
										<input type="text" v-model="sss.total_contribution_total" class="form-control form-control-sm" required>
									</div>
								</div>
								<div class="clearfix"></div><br />
								<div class="row">
									<div class="col-md-12 text-right">
										<button class="btn btn-success btn-sm" :disabled="create_sss_loading">
											<span v-if="create_sss_loading">
												Submiting..
												<span class="fa fa-cog" :class="{ 'fa-spin': create_sss_loading }"></span>
											</span>
											<span v-else>
												Submit
												<span class="fa fa-cog" :class="{ 'fa-spin': create_sss_loading }"></span>
											</span>
										</button>
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
				sss: {},
				notif: '',
				create_sss_loading: false,
				links: [
					{
						'label': 'SSS',
						'route': 'government.sss.create',
						'params': {}
					}
				]
			}
		},
		methods: {
			sssCreate(){
				this.create_sss_loading = true
				this.axiosRequest ('POST', this.$store.state.deduc + 'sss-deductions/store', this.sss)
				.then(res => {
					console.log(res.data.data)
					this.create_sss_loading = false
					this.notif = res.data
					this.tnotif (res)
				})
				.catch(err => {
					console.log(err)
					this.create_sss_loading = false
				})
			},
		}
	}
</script>

<style>
	

</style>