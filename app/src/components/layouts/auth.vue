<template lang="html">
	<div class="container">
		<div class="row mt-5">
			<div class="col-md-6 offset-md-3">

				<div class="card">
					<div class="card-header">
						<span class="fa fa-lock"></span>
						Login | {{ $store.state.project_name }}
					</div>
					<div class="card-body text-left">
						<div class="card-text">
							<form @submit.prevent="authenticate()" method="POST">
								<div class="row">
									<div class="col-3">
										Email:
									</div>
									<div class="col-9">
										<input type="text" v-model="auth.email" class="form-control form-control-sm">
									</div>
								</div>
								<div class="clearfix"></div><br />

								<div class="row">
									<div class="col-3">
										Password:
									</div>
									<div class="col-9">
										<input type="password" v-model="auth.password" class="form-control form-control-sm">
									</div>
								</div>
								<div class="clearfix"></div><br />

								<div class="row">
									<div class="col-9 offset-3 text-right">
										<button class="btn btn-sm btn-success">
											<span class="fa fa-sign-in"></span>
											{{ signin_button_label }}
										</button>
									</div>
								</div>
							</form>

						</div>
					</div>
					<div class="card-footer text-muted">
						Powered by Caimitoapps
					</div>
				</div>

			</div>
		</div>
	</div>
</template>

<script>
export default {
	data () {
		return {
			auth: {},
			signin_button_label: 'Sign in'
		}
	},

	methods: {
		authenticate () {
			this.signin_button_label = 'Signing in'
			this.$session.set('at', 'Mn7kaoLNZUEX3OAei8pzBRId4Kvxq6rH')

			window.location.href = this.$store.state.app_url + '/app/home'
			this.signin_button_label = 'Sign in'
		}
	}
}
</script>

<style lang="css" scoped>
</style>
