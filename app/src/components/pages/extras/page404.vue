<template lang="html">
	<div class="">

		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

		<div id="content">
			<div class="card">
				<div class="card-header">
					<span class="fa fa-times-circle"></span>
					Sorry
				</div>
				<div class="card-body">
					Page not found
				</div>
			</div>

		</div>
	</div>
</template>

<script type="text/javascript">
export default {
	data () {
		return {
			links: [
				{
					'label': 'Home',
					'route': 'home',
					'params': {}
				}
			]
		}
	},
}
</script>

<style lang="css" scoped>
</style>
