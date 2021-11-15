<template>
	<div>
		<ProjectList
			:options="{
					isBtnCreateShow: true
				}"
		/>
	</div>
</template>
<script>
import InputFile from '@components/Input/File'
import ProjectList from '@Common/Project/Index'
export default {
	components: {
		ProjectList,
		InputFile
	},
}
</script>