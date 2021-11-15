<template>
	<div>
		<CreateBorrowing
			:options="{
					isBtnCreateShow: true
				}"
		/>
	</div>
</template>
<script>
import 	CreateBorrowing from '../../Common/Borrowing/create.vue'
export default {
	components: {
		CreateBorrowing,
	},
}
</script>