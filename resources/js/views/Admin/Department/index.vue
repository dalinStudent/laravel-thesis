<template>
	<div>
		<DepartmentList
			:options="{
					isBtnCreateShow: true
				}"
		/>
	</div>
</template>
<script>
import DepartmentList from '../../Common/Department/index.vue'
export default {
	components: {
		DepartmentList,
	},
}
</script>