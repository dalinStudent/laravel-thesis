<template>
	<div>
		<v-dialog max-width="250px" persistent v-model="isLoading">
			<v-card>
				<div style="padding: 20px 40px">
					<v-row align="center">
						<v-progress-circular
							indeterminate
							color="primary"
							style="margin-right: 20px"
						></v-progress-circular>
						Processing ....
					</v-row>
				</div>
			</v-card>
		</v-dialog>
	</div>
</template>
<script>
export default {
	computed: {
        isLoading() {
            return this.$store.state.isLoading;
        },
	},
}
</script>