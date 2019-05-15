<template lang="html">
	<div class="">

		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

		<div id="content">
			<!-- Sub menus -->
			<span @click="redirect('government.sss.create')" class="btn btn-primary btn-sm btn-tunch">
				<span class="fa fa-plus-circle"></span>
				Create new
			</span>
			<div class="clearf"></div><br />

			<div class="card">
				<div class="card-header">
					<span class="fa fa-users"> SSS</span>
				</div>
				<div class="card-body" >
					<!-- style="white-space: nowrap; table-layout: fixed; width: 100%;" -->
					<div class="table-responsive">
						<table class="table table-bordered table-hovered" style="width:100%;">
							<thead>
								<tr>
									<th>Range of Compensation</th>
									<th>Monthly Salary Credit</th>
									<th colspan="3">Employer - Employee</th>
									<!-- <th colspan="3">Social Security</th>
									<th>Ec</th>
									<th>Total Contribution</th> -->
									<!-- <th>from</th>
									<th>To</th>
									<th >Monthly salary credit</th>
									<th>Social security er</th>
									<th>Social security ee</th>
									<th>Social security total</th>
									<th>Ec er</th>
									<th>Total contribution er</th>
									<th>Total 
									 ee</th>
									<th>Total contribution total</th> -->
									<!-- <th class="text-center">Action</th> -->
								</tr>
								
							</thead>
							<tbody v-for="sssDeduction in sssDeductions" :key="sssDeduction.id">
								<tr>
									<td rowspan="2">{{sssDeduction.to}}</td>
									<td>{{sssDeduction.from}}</td>
									<td>{{sssDeduction.monthly_salary_credit}}</td>

									<!-- <td>{{sssDeduction.from}}</td>
									<td>{{sssDeduction.to}}</td>
									<td>{{sssDeduction.monthly_salary_credit}}</td>
									<td>{{sssDeduction.social_security_er}}</td>
									<td>{{sssDeduction.social_security_ee}}</td>
									<td>{{sssDeduction.social_security_total}}</td>
									<td>{{sssDeduction.ec_er}}</td>
									<td>{{sssDeduction.total_contribution_er}}</td>
									<td>{{sssDeduction.total_contribution_ee}}</td>
									<td>{{sssDeduction.total_contribution_total}}</td> -->
									<!-- <td class="text-center btn">
										<button class="btn btn-warning btn-sm"><span class="fa fa-edit"></span></button>
										<button class="btn btn-primary btn-sm"><span class="fa fa-eye"></span></button>
										<button class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button>
									</td> -->
								</tr>
							</tbody>
						</table>
					</div>
					<hr><br>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data () {
		return {

			sssDeductions: [],
			links: [
				{
					'label': 'SSS',
					'route': 'government.sss.index',
					'params': {}
				}
			]
		}
	},

	created(){
		this.sssIndex();
	},

	methods: {
		sssIndex(){
			this.axiosRequest ('GET', this.$store.state.deduc + 'sss-deductions')
			.then(res => {
				this.sssDeductions = res.data.data
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

th{
	text-align: center;
}

td{
	text-align: center;
}

.btn{
	display: inline-block;
}
</style>
