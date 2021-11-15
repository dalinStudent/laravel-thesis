<template >
	<div>
		<v-list dense nav v-for="sidebar in sidebars" :key="sidebar.title">
			<DrawerItem
				:link="sidebar.path"
				:text="sidebar.title"
				:icon="sidebar.icon"
			/>
		</v-list>
	</div>
</template>
<script>
import DrawerItem from '@components/Drawer/Item'
export default {
	components: {
		DrawerItem
	},
	data() {
		return {
			sidebars: [
				{ title: 'Category', icon: 'fas fa-list', path: 'category' },
				{ title: 'Event', icon: 'fas fa-archway', path: 'event' },
				{ title: 'Staff', icon: 'fas fa-users', path: 'staff' },
				{ title: 'Setting', icon: 'fas fa-cog', path: 'setting' },
			]
		}
	},
}
</script>