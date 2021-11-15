<template>
	<div>
		<CategoryList
			:options="{
					isBtnCreateShow: true
				}"
		/>
	</div>
</template>
<script>
import CategoryList from '../../Common/Category/index.vue'
export default {
	components: {
		CategoryList,
	},
}
</script>