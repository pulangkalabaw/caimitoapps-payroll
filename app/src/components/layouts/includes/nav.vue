<template lang="html">
	<div>
		<div class="sidebar">
			<h3 class="title">
				{{ $store.state.project_name }}
			</h3>
			<a class="active" href="#home">Home</a>
			<a href="#news">News</a>
			<a href="#contact">Contact</a>
			<a href="#about">About</a>
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
</style>
