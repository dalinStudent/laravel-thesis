<template>
	<div>
		<v-file-input
			@change="fileChange"
			@click:clear="reset"
			dense
			outlined
			:label="label"
			accept="image/*"
			prepend-icon="fas fa-file-image"
			:truncate-length="truncateLength"
			:error="error"
			:messages="message"
			:rules="rules"
		>
			<template v-slot:append>
				<v-fade-transition leave-absolute>
					<v-progress-circular
						v-if="isLoading"
						size="24"
						indeterminate
					/>
					<!-- <div style="width:24px" v-else/> -->
				</v-fade-transition>
            </template>
		</v-file-input>
	</div>
</template>
<script>
export default {
	props: {
		truncateLength: {
			default: 30
		},
		value: {
			default: null
		},
		url: {
			default: null
		},
		label: {
			default: 'Photo'
		},
		rules: {
			default: null
		},
		error: {
			type: Boolean,
			default: false
		},
		message: {
			type: String,
			default: null
		},
	},
	data() {
		return {
			isLoading: false,
		}
	},
	methods: {
		fileChange(file) {
			if (file) {
				this.isLoading = true
				this.$chttp.uploadFile(file, 'photo').then( res => {
					this.$emit('update:value', res.data.data.file.id)
					this.$emit('update:url', res.data.data.file.url)
					this.$emit('change', res.data.data)
					this.isLoading = false
				}).catch( error => {
					this.isLoading = false
				})
			}
		},
		reset() {
			this.isLoading = true
			this.$chttp.deleteFile(this.value).then( () => {
				this.$emit('update:value', "")
				this.$emit('update:url', "")
				this.$emit('reset')
				this.isLoading = false
			}).catch( () => {
				this.isLoading = false
			})
		}
	},
}
</script>