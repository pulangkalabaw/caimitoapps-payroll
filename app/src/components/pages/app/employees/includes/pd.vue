<template lang="html">
	<div>
		<small>
			<b>Payroll details</b>
		</small>
		<table class="table">
			<tbody>

				<!-- Employement Status -->
				<tr>
					<td width="20%">Employement Status</td>
					<td>
						{{ employee.user_details.employment_status ? ucfirst(employee.user_details.employment_status) : '-' }}
					</td>
				</tr>
				
				<!-- Employement Type -->
				<tr>
					<td width="20%">Employement Type</td>
					<td>
						{{ employee.user_details.employment_type ? employementType(employee.user_details.employment_type) : '-' }}
					</td>
				</tr>

				<!-- Bank Details -->
				<tr>
					<td width="20%">Bank Details</td>
					<td>
						{{ employee.user_payroll_details.bank_details ? employee.user_payroll_details.bank_details : '-' }}
					</td>
				</tr>

				<!-- Payout Type -->
				<tr>
					<td width="20%">Payout Type</td>
					<td>
						{{ employee.user_payroll_details.payout_type ? ucfirst(employee.user_payroll_details.payout_type) : '-' }}
					</td>
				</tr>

				<!-- TIN Number -->
				<tr>
					<td width="20%">TIN Number</td>
					<td>
						{{ employee.user_payroll_details.tin_number ? employee.user_payroll_details.tin_number : '-' }}
					</td>
				</tr>

				<!-- SSS Number -->
				<tr>
					<td width="20%">SSS Number</td>
					<td>
						{{ employee.user_payroll_details.sss_number ? employee.user_payroll_details.sss_number : '-' }}
					</td>
				</tr>

				<!-- PhilHealth Number -->
				<tr>
					<td width="20%">PhilHealth Number</td>
					<td>
						{{ employee.user_payroll_details.philhealth_number ? employee.user_payroll_details.philhealth_number : '-' }}
					</td>
				</tr>

				<!-- Allowances -->
				<tr>
					<td width="20%">Compensations</td>
					<td>
						<div v-if="employee.user_compensation.length != 0">
							<ul class="list-group">
								<li class="list-group-item span-link" v-for="uc in employee.user_compensation">
									<small>
										Allowance: {{ ucfirst(uc.get_compensation.name) }} <br />
										Amount: {{ uc.amount }} <br />
										Taxable: {{ uc.taxable ? 'Taxable' : 'Non-Taxable' }} <br />
									</small>
								</li>
							</ul>
						</div>
					</td>
				</tr>

				<!-- Allowances -->
				<tr>
					<td width="20%">Deductions</td>
					<td>
						<div v-if="employee.user_deduction.length != 0">
							<ul class="list-group">
								<li class="list-group-item span-link" v-for="ud in employee.user_deduction">
									<small>
										Allowance: {{ ucfirst(ud.get_deduction.name) }} <br />
										Amount: {{ ud.amount }} <br />
										Taxable: - <br />
									</small>
								</li>
							</ul>
						</div>
						<div v-else>
							No Deductions
						</div>
					</td>
				</tr>

			</tbody>
		</table>
	</div>
</template>

<script>
export default {
	props: ['employee']
}
</script>

<style lang="css" scoped>
</style>
