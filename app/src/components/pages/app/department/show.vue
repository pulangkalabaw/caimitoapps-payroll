<template lang="html">
	<div class="">

		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

		<div id="content" v-if="!show_department_loading">
			<div class="card" :class="{ 'border-warning ': edit_mode }">
				<div class="card-header">
					<div class="row">
						<div class="col-md-6">
							<span class="fa fa-folder"></span>
							Department
						</div>
						<div class="col-md-6 text-right">
							<span @click="departmentArchive()" class="btn btn-danger btn-sm">
								<span class="fa fa-archive"></span>
								Archive this Department
							</span>
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

					<form @submit.prevent="departmentUpdate()" method="POST">

						<div class="row" v-if="!employees_loading">
							<div class="col-md-2">Department Head</div>
							<div class="col-md-4">

								<select v-model="department.department_head" :disabled="!edit_mode" class="form-control form-control-sm">
									<option :value="null">Select none</option>
									<option :value="employee.user_id" v-for="employee in employees">
										{{ employee.lname }},
										{{ employee.fname }}
									</option>
								</select>

							</div>
						</div>
						<div class="clearfix"></div><br />

						<div class="row">
							<div class="col-md-2">Department Name <span class="required">*</span></div>
							<div class="col-md-4">
								<input type="text" v-model="department.department_name" :disabled="!edit_mode" class="form-control form-control-sm" required>
							</div>
						</div>
						<div class="clearfix"></div><br />

						<div class="row">
							<div class="col-md-2">Description</div>
							<div class="col-md-4">
								<textarea :disabled="!edit_mode" v-model="department.description" class="form-control form-control-sm" cols="30" rows="10"></textarea>
							</div>
						</div>
						<div class="clearfix"></div><br />


						<div class="row" v-if="edit_mode">
							<div class="col-md-4 offset-md-2 text-right">
								<button class="btn btn-success btn-sm" :disabled="update_department_loading">
									<span v-if="update_department_loading">
										Submiting..
										<span class="fa fa-cog" :class="{ 'fa-spin': update_department_loading }"></span>
									</span>
									<span v-else>
										Submit
										<span class="fa fa-cog" :class="{ 'fa-spin': update_department_loading }"></span>
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
			employees: [],
			employees_loading: true,
			edit_mode: false,
			valid: false,

			department: {},

			show_department_loading: true,
			update_department_loading: false,

			notif: '',

			links: [
				{
					'label': 'Department',
					'route': 'department.index',
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
		this.departmentShow ();
		this.employeeIndex ();
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

		departmentArchive () {

			this.update_department_loading = true
			let params = { _method: 'DELETE' }
			this.axiosRequest ('POST', this.$store.state.pis + 'department/' + this.$route.params.id, params)
			.then (res => {

				this.notif = res.data
				this.tnotif (res)
				this.redirect ('department.index')

			})
			.catch (err => {
				console.log(err)
				this.update_department_loading = false
			})

		},

		departmentUpdate () {

			this.update_department_loading = true
			this.department._method = 'PUT'
			this.axiosRequest ('POST', this.$store.state.pis + 'department/' + this.$route.params.id, this.department)
			.then (res => {

				this.notif = res.data
				this.tnotif (res)
				this.employees  = res.data.data.data
				this.update_department_loading = false
				this.employeeIndex ()

			})
			.catch (err => {
				console.log(err)
				this.update_department_loading = false
			})
		},

		departmentShow () {

			this.show_department_loading = true
			this.axiosRequest ('GET', this.$store.state.pis + 'department/' + this.$route.params.id)
			.then (res => {

				let department  = res.data.data.data

				this.department.department_name = department.department_name
				this.department.description = department.description
				if (department.department_head) {
					this.department.department_head = department.department_head_info.user_id
				}
				else {
					this.department.department_head = ''
				}

				this.valid = res.data.status == 'success' ? true : false

				this.show_department_loading = false


			})
			.catch (err => {
				console.log(err)
				this.show_department_loading = false
			})
		},

		employeeIndex () {

			this.employees_loading = true
			this.axiosRequest ('GET', this.$store.state.pis + 'employee?show=all')
			.then (res => {

				this.employees  = res.data.data.data
				this.employees_loading = false

			})
			.catch (err => {
				console.log(err)
				this.employees_loading = false
			})
		}
	}
}
</script>

<style lang="css" scoped>
</style>
