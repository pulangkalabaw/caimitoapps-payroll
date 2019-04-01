<template lang="html">
	<div class="">

		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

		<div id="content" v-if="!jobs_loading">
			<div class="card" :class="{ 'border-warning ': edit_mode }">
				<div class="card-header">
					<div class="row">
						<div class="col-md-6">
							<span class="fa fa-folder"></span>
							{{ job.job_name }}
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
				<div class="card-body" v-if="valid">


					<div class="alert alert-warning" v-if="edit_mode">
						<span class="fa fa-warning"></span>
						<b>Warning!</b> You are in
						<b>Edit Mode</b>
					</div>
					<div class="alert alert-info" v-else>
						<span class="fa fa-info-circle"></span>
						You are in
						<b>View mode</b>
					</div>

					<notif :notif="notif"></notif>
					<div class="clearfix"></div>

					<form @submit.prevent="jobsUpdate()" method="POST">


						<div class="row">
							<div class="col-md-2">Job Name <span class="required">*</span></div>
							<div class="col-md-4">
								<input type="text" v-model="job.job_name" :disabled="!edit_mode" class="form-control form-control-sm" required>
							</div>
						</div>
						<div class="clearfix"></div><br />

						<div class="row">
							<div class="col-md-2">Description <span class="required">*</span></div>
							<div class="col-md-4">
								<textarea :disabled="!edit_mode" v-model="job.job_description" class="form-control form-control-sm" cols="30" rows="10"></textarea>
							</div>
						</div>
						<div class="clearfix"></div><br />


						<div class="row" v-if="edit_mode">
							<div class="col-md-4 offset-md-2 text-right">
								<button class="btn btn-success btn-sm" :disabled="update_jobs_loading">
									<span v-if="update_jobs_loading">
										Submiting..
										<span class="fa fa-cog" :class="{ 'fa-spin': update_jobs_loading }"></span>
									</span>
									<span v-else>
										Submit
										<span class="fa fa-cog" :class="{ 'fa-spin': update_jobs_loading }"></span>
									</span>
								</button>
							</div>
						</div>
						<div class="clearfix"></div><br />
					</form>


				</div>
				<div class="card-body" v-else>
					This page either under maintenance or not exists!
				</div>
			</div>

		</div>
	</div>
</template>

<script>
export default {
	data () {
		return {
			job: [],
			jobs_loading: true,
			edit_mode: false,
			valid: false,
			update_jobs_loading: false,

			notif: '',

			links: [
				{
					'label': 'Jobs',
					'route': 'jobs.index',
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
		this.jobsShow ();
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

		jobsUpdate () {

			this.update_jobs_loading = true
			this.job._method = 'PUT'
			this.axiosRequest ('POST', this.$store.state.empdtls + 'jobs/' + this.$route.params.id, this.job)
			.then (res => {

				this.notif = res.data
				this.tnotif (res)
				this.update_jobs_loading = false
				this.jobsShow ();

			})
			.catch (err => {
				console.log(err)
				this.update_jobs_loading = false
			})
		},

		jobsShow () {

			this.jobs_loading = true
			this.axiosRequest ('GET', this.$store.state.empdtls + 'jobs/' + this.$route.params.id)
			.then (res => {

				this.job = res.data.data.data
				this.valid = res.data.status == 'success' ? true : false
				this.jobs_loading = false


			})
			.catch (err => {
				console.log(err)
				this.jobs_loading = false
			})
		},

	}
}
</script>

<style lang="css" scoped>
</style>
