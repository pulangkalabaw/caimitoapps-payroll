<template lang="html">
	<div>
		<notifications group="notif" />
		<!-- Authenticated -->
		<div v-if="$session.get('at')">
			<navbar></navbar>
			<app></app>
		</div>
		<!-- Unauthenticated -->
		<div v-else>
			<auth></auth>
		</div>

	</div>
</template>

<script>
import navbar from '@/components/layouts/includes/nav'
import auth from '@/components/layouts/auth'
import app from '@/components/layouts/app'

export default {
	components: {
		'navbar': navbar,
		'auth': auth,
		'app': app,
	}
}
</script>

<style>

body {
	margin: 0;
	font-family: "Lato", sans-serif;
}

.btn-tunch,.btn-tunch:hover {
	background: #2A3F54;  border-color: #2A3F54;
}

.btn-tunch-default {
	background: rgba(0,0,0,.09);
	border-color: rgba(0,0,0,.1);
}


</style>
