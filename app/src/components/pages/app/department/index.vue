<template lang="html">
	<div class="">

		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

		<div id="content">
			<div class="card">
				<div class="card-header">
					<span class="fa fa-users"></span>
					Employees
				</div>
				<div class="card-body">
					<div v-if="!department_loading">
						<table class="table table-bordered table-hovered" style="width:100%">
							<thead>
								<tr>
									<th width="30%">Department name</th>
									<th width="70%">Description</th>
								</tr>
							</thead>

							<tbody v-for="dept in department.data.data" :key="dept.id">
								<tr>
									<td>
										<span class="span-link-underline">
											{{ dept.department_name }},
										</span>
									</td>
									<td>{{ dept.description }}</td>
								</tr>
							</tbody>

						</table>

						<hr>
						Total employees: <b>{{ department.total }}</b>
						<br /><br />
						<pagination :data="department.data" @pagination-change-page="departmentIndex"></pagination>

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
			department: [],
			department_loading: true,
			links: [
				{
					'label': 'Employees',
					'route': 'department.index',
					'params': {}
				}
			]
		}
	},

	created () {
		this.departmentIndex ();
		this.$notify({
			group: 'notif',
			title: 'Important message',
			text: 'Hello user! This is a notification!',
			type: 'success',
		});
	},

	methods: {

		departmentIndex (page = 1) {

			this.department_loading = true
			this.axiosRequest ('GET', this.$store.state.empdtls + 'department?page=' + page)
			.then (res => {

				this.department  = res.data.data
				this.department_loading = false

			})
			.catch (err => {
				console.log(err)
				this.department_loading = false
			})
		}
	}
}
</script>

<style lang="css" scoped>
</style>
