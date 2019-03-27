<template lang="html">
	<div>
		<div class="content-header">
			<span class="span-link">{{ $store.state.project_name }}</span>
			<span class="fa fa-angle-double-right"></span>

			<span v-if="links.length != 0">
				<span v-for="(link, index) in links">
					<span class="span-link" @click="redirect(link.route, link.params)">
						{{ link.label }}
					</span>

					<span class="fa fa-angle-double-right" v-if="index < links.length - 1"></span>
				</span>

			</span>
		</div>
	</div>
</template>

<script>
export default {
	props: ['links'],
	data () {
		return {

		}
	},

	created () {
		console.log(this.links)
	}
}
</script>

<style lang="css" scoped>
</style>
