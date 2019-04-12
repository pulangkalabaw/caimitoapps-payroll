<template lang="html">
	<div>
		<small>
			<b>Company</b>
		</small>
		<table class="table">
			<tbody>

				<!-- Employement Type -->
				<tr>
					<td width="20%">Employement Type</td>
					<td>
						{{ employee.user_details.employment_type ? employementType(employee.user_details.employment_type) : '-' }}
					</td>
				</tr>

				<!-- Employement Status -->
				<tr>
					<td width="20%">Employement Status</td>
					<td>
						{{ employee.user_details.employment_status ? ucfirst(employee.user_details.employment_status) : '-' }}
					</td>
				</tr>

				<!-- Department -->
				<tr>
					<td width="20%">Department</td>
					<td>
						{{ employee.user_details.department_id ? employee.user_details.department.department_name.toUpperCase() : '-' }}
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
