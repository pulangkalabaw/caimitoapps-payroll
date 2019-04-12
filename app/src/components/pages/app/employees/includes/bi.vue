<template lang="html">
	<div>
		<small>
			<b>Basic information</b>
		</small>
		<table class="table">
			<tbody>

				<!-- Email -->
				<tr>
					<td width="20%">Email</td>
					<td>
						{{ employee.email }}
					</td>
				</tr>

				<!-- Suffix -->
				<tr>
					<td width="20%">Suffix</td>
					<td>
						{{ employee.suffix ? ucfirst(employee.suffix) : 'No suffix' }}
					</td>
				</tr>

				<!-- Status -->
				<tr>
					<td width="20%">
						Status
					</td>
					<td>
						{{ employee.status ? 'Active account' : 'Deactived account' }}
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
