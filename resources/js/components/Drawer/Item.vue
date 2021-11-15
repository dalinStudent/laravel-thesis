<template>
	<v-list-item class="drawer__item" :to="{name: routeName}" active-class="active-route">
		<v-list-item-icon>
			<v-icon class="icon">{{ icon }}</v-icon>
		</v-list-item-icon>
		<v-list-item-content class="title">
			<v-list-item-title>{{ text }}</v-list-item-title>
		</v-list-item-content>
	</v-list-item>
</template>
<script>
export default {
	props: {
		icon: {
			type: String,
			default: 'fas fa-sign-out-alt'
		},
		text: {
			type: String,
			default: 'Drawer Item'
		},
		routeName: {
			type: String,
			default: '/'
		}
	}
}
</script>