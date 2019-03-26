<template lang="html">
	<div class="footer">
		<i>
			app version: {{ $store.state.version }}
			@{{ $store.state.d }}
		</i>
	</div>
</template>

<script>
export default {
}
</script>

<style lang="css" scoped>
.footer {
	position: fixed;
	bottom: 0;
}
</style>
