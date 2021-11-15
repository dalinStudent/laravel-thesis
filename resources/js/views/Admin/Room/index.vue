<template>
	<div>
		<RoomList
			:options="{
					isBtnCreateShow: true
				}"
		/>
	</div>
</template>
<script>
import RoomList from '../../Common/Room/index.vue'
export default {
	components: {
		RoomList,
	},
}
</script>