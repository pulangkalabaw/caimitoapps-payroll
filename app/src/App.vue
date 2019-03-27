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
.span-link {
	cursor: pointer;
}
.content-header {
	padding: 10px 240px;
	width: 100%;
	background: #EDEDED;
	border-bottom: 1px solid #D9DEE4;
}
.sidebar {
	margin: 0;
	padding: 0;
	width: 230px;
	background-color: #2A3F54;
	position: absolute;
	height: 100%;
	overflow: auto;
	font-size: 15px;
}

.sidebar span {
	display: block;
	color: #fff;
	padding: 16px;
	text-decoration: none;
}

.sidebar span.active {
	color: white;
	text-shadow: rgba(0,0,0,0.25) 0 -1px 0;
	background: linear-gradient(#334556, #2C4257),#2A3F54;
	box-shadow: rgba(0,0,0,0.25) 0 1px 0, inset rgba(255,255,255,0.16) 0 1px 0;
}

div.content #content {
	margin-left: 230px;
	padding: 1px 16px;
}

@media screen and (max-width: 700px) {
	.sidebar {
		width: 100%;
		height: auto;
		position: relative;
	}
	.sidebar span {float: left;}
	div.content #content {margin-left: 0;}
	.content-header {
		padding: 10px 10px;
	}
}

@media screen and (max-width: 400px) {
	.sidebar span {
		text-align: center;
		float: none;
	}
	.content-header {
		padding: 10px 10px;
	}
}
</style>
