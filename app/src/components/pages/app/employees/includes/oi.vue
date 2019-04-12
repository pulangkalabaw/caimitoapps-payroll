<template lang="html">
 <div>
	 <table class="table">
 		<tbody>

 			<!-- Email -->
 			<tr>
 				<td width="20%">Mobile</td>
 				<td>
 					{{ employee.mobile_no }}
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
