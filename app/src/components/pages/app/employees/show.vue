<template lang="html">
	<div class="">

		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

		<div id="content" v-if="!show_employee_loading">

			<!-- Sub Menus -->
			<span @click="redirect('employees.create')" class="btn btn-primary btn-sm btn-tunch">
				<span class="fa fa-plus-circle"></span>
				Create new
			</span>
			<span @click="redirect('employees.index')" class="btn btn-default btn-sm btn-tunch-default">
				<span class="fa fa-th-list"></span>
				View all
			</span>
			<div class="clearfix"></div><br />


			<div class="card" :class="{ 'border-warning ': edit_mode }">
				<div class="card-header">
					<div class="row">
						<div class="col-md-6">
							<span class="fa fa-users"></span>
							Employee
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
					<img src="/static/img/default-avatar.png" alt="">
					{{ employee }}
				</div>
				<div class="card-body" v-else>
					This page either under maintenance or not exists!
				</div>
			</div>

		</div>
	</div>
</template>

<script>
import Tabs from 'vue-tabs-with-active-line';
export default {
	components: {
		Tabs,
	},
	data () {
		return {
			employee: {},
			show_employee_loading: false,
			update_employee_loading: false,
			valid: false,

			departments: [],
			departments_loading: false,
			dept_id: '696969',

			edit_mode: false,

			notif: '',

			links: [
				{
					'label': 'Employees',
					'route': 'employees.index',
					'params': {}
				},
				{
					'label': 'View',
					'route': '',
					'params': {}
				}
			],
			tabs: [
				{ title: 'Basic Information', value: 'bi' },
				{ title: 'Other Information', value: 'oi' },
				{ title: 'Company', value: 'co' },
				{ title: 'Payroll Details', value: 'pd' },
			],
			currentTab: 'bi',
		}
	},

	created () {
		this.employeeShow()
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

		handleClick(newTab) {
			this.currentTab = newTab;
		},

		departmentIndex () {

			this.departments_loading = true
			this.axiosRequest ('GET', this.$store.state.pis + 'department?filter=active')
			.then (res => {
				this.departments = res.data.data
				this.departments_loading = false
			})
			.catch(err => {
				console.log(err)
				this.departments_loading = false
			})
		},

		employeeShow () {

			this.show_employee_loading = true
			this.axiosRequest ('GET', this.$store.state.pis + 'employee/' + this.$route.params.id)
			.then (res => {

				this.employee = res.data.data.data
				this.show_employee_loading = false
				if (this.employee.user_details.department_id != null) {
					this.dept_id = this.employee.user_details.department_id
				}
				else {
					this.dept_id = "696969"
				}
				this.valid = res.data.status == 'success' ? true : false
				this.departmentIndex()

			})
			.catch (err => {
				console.log(err)
				this.show_employee_loading = false
			})

		},

		employeeUpdate () {

			this.update_employee_loading = true
			this.employee._method = 'PUT'

			let dept_id_value = this.dept_id == '696969' ? null : this.dept_id
			this.employee.user_details.department_id = dept_id_value
			this.axiosRequest ('POST', this.$store.state.pis + 'employee/' + this.$route.params.id, this.employee)
			.then (res => {
				this.notif = res.data
				this.update_employee_loading = false
				this.tnotif (res)

			})
			.catch (err => {
				console.log(err)
				this.update_employee_loading = false
			})

		}
	}
}
</script>
