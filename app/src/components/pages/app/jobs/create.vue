<template lang="html">
	<div class="">

		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

		<div id="content">
			<div class="card">
				<div class="card-header">
					<span class="fa fa-folder"></span>
					Create new Job
				</div>
				<div class="card-body">

					<notif :notif="notif"></notif>
					<div class="clearfix"></div>

					<form @submit.prevent="jobsCreate()" method="POST">

						<div class="row">
							<div class="col-md-2">Job Name <span class="required">*</span></div>
							<div class="col-md-4">
								<input type="text" v-model="job.job_name" class="form-control form-control-sm" required>
							</div>
						</div>
						<div class="clearfix"></div><br />

						<div class="row">
							<div class="col-md-2">Description <span class="required">*</span></div>
							<div class="col-md-4">
								<textarea v-model="job.job_description" class="form-control form-control-sm" cols="30" rows="10"></textarea>
							</div>
						</div>
						<div class="clearfix"></div><br />


						<div class="row">
							<div class="col-md-4 offset-md-2 text-right">
								<button class="btn btn-success btn-sm" :disabled="create_jobs_loading">
									<span v-if="create_jobs_loading">
										Submiting..
										<span class="fa fa-cog" :class="{ 'fa-spin': create_jobs_loading }"></span>
									</span>
									<span v-else>
										Submit
										<span class="fa fa-cog" :class="{ 'fa-spin': create_jobs_loading }"></span>
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
			job: {},
			create_jobs_loading: false,
			notif: '',

			links: [
				{
					'label': 'Jobs',
					'route': 'jobs.index',
					'params': {}
				}
			]
		}
	},

	created () {

	},

	methods: {

		jobsCreate () {
			this.create_jobs_loading = true
			this.axiosRequest ('POST', this.$store.state.pis + 'jobs', this.job)
			.then (res => {

				this.notif = res.data
				this.tnotif (res)
				this.employees  = res.data.data.data
				this.create_jobs_loading = false

			})
			.catch (err => {
				console.log(err)
				this.create_jobs_loading = false
			})
		},

	}
}
</script>

<style lang="css" scoped>
</style>
