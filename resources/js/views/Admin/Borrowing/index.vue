<template>
	<div>
		<BorrowingList
			:options="{
					isBtnCreateShow: true
				}"
		/>
	</div>
</template>
<script>
import 	BorrowingList from '../../Common/Borrowing/index.vue'
export default {
	components: {
		BorrowingList,
	},
}
</script>