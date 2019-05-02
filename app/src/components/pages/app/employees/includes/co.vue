<template lang="html">
	<div>
		<small>
			<b>Company</b>
		</small>
		<table class="table">
			<tbody>


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
