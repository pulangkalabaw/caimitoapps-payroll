<template lang="html">
	<div class="">

		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

		<div id="content">

			<!-- Sub menus -->
			<span @click="redirect('deduction.create')" class="btn btn-primary btn-sm btn-tunch">
				<span class="fa fa-plus-circle"></span>
				Create new
			</span>
			<span @click="redirect('deduction.index')" class="btn btn-default btn-sm btn-tunch-default">
				<span class="fa fa-th-list"></span>
				View all
			</span>
			<div class="clearfix"></div><br />

			<div class="card">
				<div class="card-header">
					<span class="fa fa-tasks"></span>
					Deductions
				</div>
				<div class="card-body">
					<div v-if="!deduction_loading">
						<table class="table table-bordered table-hovered" style="width:100%">
							<thead>
								<tr>
									<th width="40%">Deduction name</th>
									<th width="30%">Amount</th>
									<th width="30%">Taxable</th>
								</tr>
							</thead>

							<tbody v-for="deduction in deductions.data.data" :key="deduction.id">
								<tr>
									<td>
										<span class="span-link-underline" @click="redirect('deduction.show', {id:deduction.deduction_id})">
											{{ deduction.name }}
										</span>
									</td>
									<td>
										{{ deduction.amount }}
									</td>
									<td>
										{{ deduction.taxable == 'at' ? 'After Tax' : 'Before Tax' }}
									</td>
								</tr>
							</tbody>

						</table>

						<hr>
						Total deductions: <b>{{ deductions.total }}</b>
						<br /><br />
						<pagination :data="deductions.data" @pagination-change-page="deductionIndex"></pagination>

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
			deductions: [],
			deduction_loading: true,
			links: [
				{
					'label': 'Deductions',
					'route': 'deduction.index',
					'params': {}
				}
			]
		}
	},

	created () {
		this.deductionIndex ();
	},

	methods: {

		deductionIndex (page = 1) {
			this.deduction_loading = true
			this.axiosRequest ('GET', this.$store.state.deduc + 'deduction?page=' + page)
			.then (res => {

				this.deductions  = res.data.data
				this.deduction_loading = false

			})
			.catch (err => {
				console.log(err)
				this.deduction_loading = false
			})
		}
	}
}
</script>

<style lang="css" scoped>
</style>
