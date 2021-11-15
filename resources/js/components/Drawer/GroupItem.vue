<template>
	<div>
		<v-list-group :prepend-icon="icon" class="drawer__item">
			<template v-slot:activator>
                <v-list-item-title class="title">
                    {{ title }}
                </v-list-item-title>
            </template>
			<slot name="items"/>
		</v-list-group>
	</div>
</template>
<script>
export default {
	props: {
		icon: {
			type: String,
			default: null
		},
		title: {
			type: String,
			default: "title"
		}
	}
}
</script>