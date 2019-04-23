<template lang="html">
	<div class="">

		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

		<div id="content">

			<!-- Sub Menus -->
			<span @click="redirect('compensation.create')" class="btn btn-primary btn-sm btn-tunch">
				<span class="fa fa-plus-circle"></span>
				Create new
			</span>
			<span @click="redirect('compensation.assign')" class="btn btn-primary btn-sm btn-tunch">
				<span class="fa fa-plus-circle"></span>
				Assign Compensation
			</span>
			<div class="clearfix"></div><br />


			<div class="card">
				<div class="card-header">
					<span class="fa fa-tasks"></span>
					Compensation
				</div>
				<div class="card-body">
					<div v-if="!allowances_loading">
						<table class="table table-bordered table-hovered" style="width:100%">
							<thead>
								<tr>
									<th width="40%">Compensation name</th>
									<th width="30%">Amount</th>
									<th width="30%">Taxable</th>
								</tr>
							</thead>

							<tbody v-for="allowance in allowances.data.data" :key="allowance.id">
								<tr>
									<td>
										<span class="span-link-underline" @click="redirect('compensation.show', {id:allowance.compensation_id})">
											{{ allowance.name }}
										</span>
									</td>
									<td>
										{{ allowance.amount }}
									</td>
									<td>
										{{ allowance.taxable ? 'Yes' : 'No' }}
									</td>
								</tr>
							</tbody>

						</table>

						<hr>
						Total Compensation: <b>{{ allowances.total }}</b>
						<br /><br />
						<pagination :data="allowances.data" @pagination-change-page="allowancesIndex"></pagination>

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
			allowances: [],
			allowances_loading: true,
			links: [
				{
					'label': 'Compensation',
					'route': 'compensation.index',
					'params': {}
				}
			]
		}
	},

	created () {
		this.allowancesIndex ();
	},

	methods: {

		allowancesIndex (page = 1) {

			this.allowances_loading = true
			this.axiosRequest ('GET', this.$store.state.comp + 'compensation?page=' + page)
			.then (res => {

				this.allowances  = res.data.data
				this.allowances_loading = false

			})
			.catch (err => {
				console.log(err)
				this.allowances_loading = false
			})
		}
	}
}
</script>

<style lang="css" scoped>
</style>
