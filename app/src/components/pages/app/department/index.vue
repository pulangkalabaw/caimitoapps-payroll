<template lang="html">
	<div class="">

		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

		<div id="content">
			<div class="card">
				<div class="card-header">
					<span class="fa fa-users"></span>
					Departments
				</div>
				<div class="card-body">
					<div v-if="!department_loading">
						<table class="table table-bordered table-hovered" style="width:100%">
							<thead>
								<tr>
									<th width="30%">Department name</th>
									<th width="70%">Department head</th>
								</tr>
							</thead>

							<tbody v-for="dept in department.data.data" :key="dept.id">
								<tr>
									<td>
										<span class="span-link-underline" @click="redirect('department.show', {id:dept.department_id})">
											{{ dept.department_name }}
										</span>
									</td>
									<td>
										<label v-if="dept.department_head">
											{{ dept.department_head.fname }}
											{{ dept.department_head.lname }}
										</label>
										<label v-else>
											No department head selected
										</label>
									</td>
								</tr>
							</tbody>

						</table>

						<hr>
						Total departments: <b>{{ department.total }}</b>
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
					'label': 'Departments',
					'route': 'department.index',
					'params': {}
				}
			]
		}
	},

	created () {
		this.departmentIndex ();
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
