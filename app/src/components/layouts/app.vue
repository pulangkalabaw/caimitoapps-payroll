<template lang="html">
	<div>
		<div class="content">
			<router-view class=""></router-view>
			<appfooter></appfooter>
		</div>
	</div>

</template>

<script>
import navbar from '@/components/layouts/includes/nav'
import footer from '@/components/layouts/includes/footer'
export default {
	components: {
		'navbar': navbar,
		'appfooter': footer,
	}
}
</script>

<style lang="css" scoped>
</style>
