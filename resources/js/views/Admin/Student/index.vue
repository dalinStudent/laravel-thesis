<template>
	<div>
		<StudentList
			:options="{
					isBtnCreateShow: true
				}"
		/>
	</div>
</template>
<script>
import StudentList from '../../Common/Student/index.vue'
export default {
	components: {
		StudentList,
	},
}
</script>