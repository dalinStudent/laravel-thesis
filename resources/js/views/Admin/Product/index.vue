<template>
	<div>
		<ProductList
			:options="{
					isBtnCreateShow: true
				}"
		/>
	</div>
</template>
<script>
import ProductList from '../../Common/Product/index.vue'
export default {
	components: {
		ProductList,
	},
}
</script>