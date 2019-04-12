<template lang="html">
	<div>
		<small>
			<b>Other information</b>
		</small>
		<table class="table">
			<tbody>

				<!-- Email -->
				<tr>
					<td width="20%">Mobile number</td>
					<td>
						{{ employee.user_details.mobile_number ? employee.user_details.mobile_number : '-' }}
					</td>
				</tr>

				<!-- Present Address -->
				<tr>
					<td width="20%">Present Address</td>
					<td>
						{{ employee.user_details.mobile_number ? employee.user_details.mobile_number : '-' }}
					</td>
				</tr>

				<!-- Province Address -->
				<tr>
					<td width="20%">Province Address</td>
					<td>
						{{ employee.user_details.province_address ? employee.user_details.province_address : '-' }}
					</td>
				</tr>

				<!-- Birth Date -->
				<tr>
					<td width="20%">Birth Date</td>
					<td>
						{{ employee.user_details.birth_date ? employee.user_details.birth_date : '-' }}
					</td>
				</tr>

				<!-- Birth Place -->
				<tr>
					<td width="20%">Birth Place</td>
					<td>
						{{ employee.user_details.birth_place ? employee.user_details.birth_place : '-' }}
					</td>
				</tr>

				<!-- Religion -->
				<tr>
					<td width="20%">Religion</td>
					<td>
						{{ employee.user_details.religion ? employee.user_details.religion : '-' }}
					</td>
				</tr>

				<!-- Marital Status -->
				<tr>
					<td width="20%">Marital Status</td>
					<td>
						{{ employee.user_details.marital_status ? employee.user_details.marital_status : '-' }}
					</td>
				</tr>

				<!-- Gender -->
				<tr>
					<td width="20%">Gender</td>
					<td>
						{{ employee.user_details.gender ? employee.user_details.gender : '-' }}
					</td>
				</tr>

				<!-- Citizenship -->
				<tr>
					<td width="20%">Citizenship</td>
					<td>
						{{ employee.user_details.citizenship ? employee.user_details.citizenship : '-' }}
					</td>
				</tr>

				<!-- Height -->
				<tr>
					<td width="20%">Height</td>
					<td>
						{{ employee.user_details.height ? employee.user_details.height : '-' }}
					</td>
				</tr>

				<!-- Weight -->
				<tr>
					<td width="20%">Weight</td>
					<td>
						{{ employee.user_details.weight ? employee.user_details.weight : '-' }}
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
