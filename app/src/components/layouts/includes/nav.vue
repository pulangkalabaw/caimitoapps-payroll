<template lang="html">
	<div>
		<div class="sidebar">
			<h3 class="title">
				{{ $store.state.project_name }}
			</h3>
			<ul class="mainmenu">
				<li>
					<span @click="redirect('home')" class="span-link" :class="{ 'active': $route.name.includes('home')}">
						<i class="fa fa-home"></i> &nbsp;
						Home
					</span>
				</li>
				<li>
					<span class="span-link" :class="{ 'active': $route.name.includes('employees.index')}">
						<i class="fa fa-users"></i> &nbsp;
						PIS
						<i class="float-right fa fa-chevron-down"></i>
					</span>
					<ul class="submenu">
						<li>
							<span @click="redirect('employees.index')" class="span-link">
								View all
							</span>
						</li>
						<li>
							<span @click="redirect('employees.create')" class="span-link">
								Create new
							</span>
						</li>
					</ul>
				</li>
				<li>
					<span class="span-link" :class="{ 'active': $route.name.includes('department.index')}">
						<i class="fa fa-folder"></i> &nbsp;
						Department
						<i class="float-right fa fa-chevron-down"></i>
					</span>
					<ul class="submenu">
						<li>
							<span @click="redirect('department.index')" class="span-link">
								View all
							</span>
						</li>
						<li>
							<span @click="redirect('department.create')" class="span-link">
								Create new
							</span>
						</li>
					</ul>
				</li>
				<!-- <li>
					<span class="span-link" :class="{ 'active': $route.name.includes('jobs.index')}">
						<i class="fa fa-tasks"></i> &nbsp;
						Jobs
						<i class="float-right fa fa-chevron-down"></i>
					</span>
					<ul class="submenu">
						<li>
							<span @click="redirect('jobs.index')" class="span-link">
								View all
							</span>
						</li>
						<li>
							<span @click="redirect('jobs.create')" class="span-link">
								Create new
							</span>
						</li>
					</ul>
				</li> -->
				<li>
					<span class="span-link" :class="{ 'active': $route.name.includes('compensation.index')}">
						<i class="fa fa-tasks"></i> &nbsp;
						Compensation
						<i class="float-right fa fa-chevron-down"></i>
					</span>
					<ul class="submenu">
						<li :class="{ 'active': $route.name.includes('compensation.index')}">
							<span @click="redirect('compensation.index')" class="span-link">
								View all
							</span>
						</li>
						<li>
							<span @click="redirect('compensation.create')" class="span-link">
								Create new
							</span>
						</li>
						<li>
							<span @click="redirect('compensation.assign')" class="span-link">
								Assign
							</span>
						</li>
					</ul>
				</li>

				<li>
					<span class="span-link" :class="{ 'active': $route.name.includes('deduction.index')}">
						<i class="fa fa-tasks"></i> &nbsp;
						Deductions
						<i class="float-right fa fa-chevron-down"></i>
					</span>
					<ul class="submenu">
						<li>
							<span @click="redirect('deduction.index')" class="span-link">
								View all
							</span>
						</li>
						<li>
							<span @click="redirect('deduction.create')" class="span-link">
								Create new
							</span>
						</li>
						<li>
							<span @click="redirect('deduction.assign')" class="span-link">
								Assign
							</span>
						</li>
					</ul>
				</li>

				<li>
					<span class="span-link" :class="{ 'active': $route.name.includes('leave.index')}">
						<i class="fa fa-tasks"></i> &nbsp;
						Leaves
						<i class="float-right fa fa-chevron-down"></i>
					</span>
					<ul class="submenu">
						<li>
							<span @click="redirect('leaves.index')" class="span-link">
								Leave Management
							</span>
						</li>
						<li>
							<span @click="redirect('leavecredit.index')" class="span-link">
								Leave credits
							</span>
						</li>
					</ul>
				</li>

				<li>
					<span class="span-link" :class="{ 'active': $route.name.includes('leave.index')}">
						<i class="fa fa-tasks"></i> &nbsp;
						Government
						<i class="float-right fa fa-chevron-down"></i>
					</span>
					<ul class="submenu">
						<li>
							<span class="span-link" :class="{ 'active': $route.name.includes('leave.index')}">
								<i class="fa fa-tasks"></i> &nbsp;
								Sss
								<i class="float-right fa fa-chevron-down"></i>
							</span>
							<ul class="submenu">
								<li>
									<span @click="redirect('government.sss.index')" class="span-link">
										View all
									</span>
								</li>
								<li>
									<span @click="redirect('government.sss.create')" class="span-link">
										Create new
									</span>
								</li>
							</ul>
						</li>
					</ul>
					<ul class="submenu">
						<li>
							<span class="span-link" :class="{ 'active': $route.name.includes('leave.index')}">
								<i class="fa fa-tasks"></i> &nbsp;
								Tax
								<i class="float-right fa fa-chevron-down"></i>
							</span>
							<ul class="submenu">
								<li>
									<span @click="redirect('government.tax.index')" class="span-link">
										View all
									</span>
								</li>
								<li>
									<span @click="redirect('government.tax.create')" class="span-link">
										Create new
									</span>
								</li>
							</ul>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</template>

<script>
export default {
	methods: {
		logout () {
			this.$session.destroy()
			window.location.href = this.$store.state.app_url
		}
	}
}
</script>
<style media="screen">
.title {
	display: block;
	color: #fff;
	padding: 16px;
	text-decoration: none;
}
.mainmenu, .submenu {
	list-style: none;
	padding: 0;
	margin: 0;
}
.mainmenu li:hover .submenu {
	display: block;
	max-height: 300px;
	padding-left: 30px;outline: 0;
}
.submenu {
	overflow: hidden;
	max-height: 0;
	-webkit-transition: all 0.5s ease-out;
}
</style>
