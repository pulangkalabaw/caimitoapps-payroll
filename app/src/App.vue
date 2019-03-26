<template lang="html">
	<div>
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
.content-header {
	background: #f1f1f1;
	padding: 1px 210px;
	width: 100%;
}
.sidebar {
	margin: 0;
	padding: 0;
	width: 200px;
	background-color: #2A3F54;
	position: fixed;
	height: 100%;
	overflow: auto;
}

.sidebar a {
	display: block;
	color: #fff;
	padding: 16px;
	text-decoration: none;
}

.sidebar a.active {
	color: white;
	text-shadow: rgba(0,0,0,0.25) 0 -1px 0;
	background: linear-gradient(#334556, #2C4257),#2A3F54;
	box-shadow: rgba(0,0,0,0.25) 0 1px 0, inset rgba(255,255,255,0.16) 0 1px 0;
}

div.content #content {
	margin-left: 200px;
	padding: 1px 16px;
	height: 1000px;
}

@media screen and (max-width: 700px) {
	.sidebar {
		width: 100%;
		height: auto;
		position: relative;
	}
	.sidebar a {float: left;}
	div.content #content {margin-left: 0;}
	.content-header {margin-left: 0;}
}

@media screen and (max-width: 400px) {
	.sidebar a {
		text-align: center;
		float: none;
	}
}
</style>
