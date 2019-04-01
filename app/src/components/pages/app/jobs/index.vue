<template lang="html">
	<div class="">

		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

		<div id="content">
			<div class="card">
				<div class="card-header">
					<span class="fa fa-tasks"></span>
					Jobs
				</div>
				<div class="card-body">
					<div v-if="!jobs_loading">
						<table class="table table-bordered table-hovered" style="width:100%">
							<thead>
								<tr>
									<th width="30%">Job name</th>
									<th width="70%">Job Description</th>
								</tr>
							</thead>

							<tbody v-for="job in jobs.data.data" :key="job.id">
								<tr>
									<td>
										<span class="span-link-underline" @click="redirect('jobs.show', {id:job.job_id})">
											{{ job.job_name }}
										</span>
									</td>
									<td>
										{{ str_limit(job.job_description, 50) }}
									</td>
								</tr>
							</tbody>

						</table>

						<hr>
						Total departments: <b>{{ jobs.total }}</b>
						<br /><br />
						<pagination :data="jobs.data" @pagination-change-page="jobsIndex"></pagination>

					</div>
				</div>
			</div>

		</div>
	</div>
</template>

<script>
export default {
	data () {
		return {
			jobs: [],
			jobs_loading: true,
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
		this.jobsIndex ();
	},

	methods: {

		jobsIndex (page = 1) {

			this.jobs_loading = true
			this.axiosRequest ('GET', this.$store.state.empdtls + 'jobs?page=' + page)
			.then (res => {

				this.jobs  = res.data.data
				this.jobs_loading = false

			})
			.catch (err => {
				console.log(err)
				this.jobs_loading = false
			})
		}
	}
}
</script>

<style lang="css" scoped>
</style>
