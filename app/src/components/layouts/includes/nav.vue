<template lang="html">
	<div>
		<div class="sidebar">
			<h3 class="title">
				{{ $store.state.project_name }}
			</h3>
			<hr>
			<ul class="mainmenu">
				<li>
					<span class="span-link" :class="{ 'active': $route.name.includes('home')}">
						<i class="fa fa-home"></i> &nbsp;
						Home
					</span>
				</li>
				<li>
					<span @click="redirect('employees.index')" class="span-link" :class="{ 'active': $route.name.includes('employees.index')}">
						<i class="fa fa-users"></i> &nbsp;
						Employees
					</span>
				</li>
				<li>
					<span class="span-link text-left">
						<i class="fa fa-th-list"></i> &nbsp;
						Products &nbsp;
						<i class="float-right fa fa-chevron-down"></i>
					</span>

					<ul class="submenu">
						<li>
							<span class="span-link">Home</span>
						</li>
						<li>
							<span class="span-link">Home</span>
						</li>
						<li>
							<span class="span-link">Home</span>
						</li>
						<li>
							<span class="span-link">Home</span>
						</li>
						<li>
							<span class="span-link">Home</span>
						</li>
					</ul>
				</li>
				<li>
					<span class="span-link">
						<i class="fa fa-home"></i> &nbsp;
						Home
					</span>
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
	padding-left: 50px;
}
.submenu {
	overflow: hidden;
	max-height: 0;
	-webkit-transition: all 0.5s ease-out;
}
</style>
