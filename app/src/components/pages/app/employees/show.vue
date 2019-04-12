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


			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-md-6">
							<span class="fa fa-users"></span>
							Employee
						</div>
						<div class="col-md-6 text-right" v-if="valid">
							<span class="span-link btn-sm" @click="redirect('employees.edit', {id:employee.user_id})">
								<span class="fa fa-edit"></span>
								Edit Profile
							</span>
						</div>
					</div>
				</div>
				<div class="card-body" v-if="valid">
					<div class="row">

						<!-- Left Side -->
						<div class="col-md-3">
							<img src="/static/img/default-avatar.png" alt="Avatar" class="default-avatar-md">
							<hr>

							<small>
								<b>Main Menu</b>
							</small>
							<ul class="list-group">
								<li class="list-group-item span-link" @click="current_tab = 'bi'">
									Basic Information
								</li>
								<li class="list-group-item span-link" @click="current_tab = 'oi'">
									Other Information
								</li>
								<li class="list-group-item span-link" @click="current_tab = 'co'">
									Company
								</li>
								<li class="list-group-item span-link" @click="current_tab = 'pd'">
									Payroll Details
								</li>
							</ul>
							<br />

							<small>
								<b>Other</b>
							</small>
							<ul class="list-group">
								<li class="list-group-item span-link" @click="current_tab = 'add_comp'">
									<span class="fa fa-plus fa-xx"></span>
									Add Compensation
								</li>
								<li class="list-group-item span-link" @click="current_tab = 'add_deduc'">
									<span class="fa fa-plus fa-xx"></span>
									Add Deduction
								</li>
								<li class="list-group-item span-link" @click="current_tab = 'oi'">
									<span class="fa fa-plus fa-xx"></span>
									Add loan
								</li>
							</ul>
						</div>

						<!-- Right side -->
						<div class="col-md-9">

							<div class="row">
								<div class="col-md-12">
									<h1>
										{{ employee.employee_code }}
										{{ employee.lname }}
										{{ employee.fname }}
										{{ employee.mname }}
									</h1>
									<!-- {{ current_tab }} -->

									<!--
									Basic Information
									***-->
									<div v-if="current_tab == 'bi'">
										<bi :employee="employee"></bi>
									</div>

									<!--
									Other Information
									***-->
									<div v-if="current_tab == 'oi'">
										<oi :employee="employee"></oi>
									</div>

									<!--
									Company
									***-->
									<div v-if="current_tab == 'co'">
										<co :employee="employee"></co>
									</div>

									<!--
									Payroll Details
									***-->
									<div v-if="current_tab == 'pd'">
										<pd :employee="employee"></pd>
									</div>


									<!--
									Add compensation
									***-->
									<div v-if="current_tab == 'add_comp'">
										<add-comp :employee="employee"></add-comp>
									</div>


									<!--
									Add deduction
									***-->
									<div v-if="current_tab == 'add_deduc'">
										<add-deduc :employee="employee"></add-deduc>
									</div>



								</div>
							</div>


						</div>

					</div>
					<!-- {{employee }} -->

				</div> <!-- Card body -->
				<div class="card-body" v-else>
					This page either under maintenance or not exists!
				</div>
			</div>

		</div>
	</div>
</template>

<script>
import Tabs from 'vue-tabs-with-active-line';
import bi from '@/components/pages/app/employees/includes/bi'
import oi from '@/components/pages/app/employees/includes/oi'
import co from '@/components/pages/app/employees/includes/co'
import pd from '@/components/pages/app/employees/includes/pd'
import add_comp from '@/components/pages/app/employees/includes/add_comp'
import add_deduc from '@/components/pages/app/employees/includes/add_deduc'

export default {
	components: {
		Tabs,
		'bi': bi,
		'oi': oi,
		'co': co,
		'pd': pd,
		'add-comp': add_comp,
		'add-deduc': add_deduc,
	},
	data () {
		return {
			current_tab: 'bi',
			show_employee_loading: true,
			employee: {},

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
		}
	},

	created () {
		this.employeeShow()
	},

	methods: {

		// editMode (des){
		// 	this.edit_mode = des
		// 	if (des == true) {
		// 		this.$notify({
		// 			group: 'notif',
		// 			title: 'Employee',
		// 			text: 'You are in Edit Mode',
		// 			type: 'warn',
		// 		});
		// 	}
		// 	else {
		// 		this.$notify({
		// 			group: 'notif',
		// 			title: 'Employee',
		// 			text: 'You are in View Mode',
		// 			type: 'info',
		// 		});
		// 	}
		// },

		// handleClick(newTab) {
		// 	this.currentTab = newTab;
		// },

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
