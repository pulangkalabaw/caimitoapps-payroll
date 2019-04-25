<template lang="html">
	<div class="">

		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

		<div id="content">
			<!-- Sub menus -->
			<span @click="redirect('government.tax.create')" class="btn btn-primary btn-sm btn-tunch">
				<span class="fa fa-plus-circle"></span>
				Create new
			</span>
			<div class="clearf"></div><br />

			<div class="card">
				<div class="card-header">
					<span class="fa fa-money"></span>
					Tax
				</div>
				<div class="card-body">
					<table class="table table-bordered table-hovered" style="width:100%">
						<thead>
							<tr>
								<th>Wage type</th>
								<th>Compensation range from</th>
								<th>Compensation range to</th>
								<th>Prescribed with holding tax</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody v-for="taxDeduction in taxDeductions">
							<tr>
								<td>{{taxDeduction.wage_type}}</td>
								<td>{{taxDeduction.compensation_range_from}}</td>
								<td>{{taxDeduction.compensation_range_to}}</td>
								<td>{{taxDeduction.prescribed_withholding_tax}}</td>
								<td class="text-center">
									<button class="btn btn-success btn-sm"><span class="fa fa-edit"></span></button>
									<button class="btn btn-primary btn-sm"><span class="fa fa-eye"></span></button>
									<button class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data () {
		return {
			taxDeductions: [],
			links: [
				{
					'label': 'Tax',
					'route': 'government.tax.index',
					'params': {}
				}
			]
		}
	},

	created(){
		this.taxIndex();
	},

	methods: {

		taxIndex(){
			this.axiosRequest ('GET', this.$store.state.deduc + 'tax-deductions')
			.then(res => {
				this.taxDeductions = res.data.data
				console.log(res)
			})
			.catch(err => {
				console.log(err)
			})
		}

	}
}
</script>

<style lang="css" scoped>
</style>
