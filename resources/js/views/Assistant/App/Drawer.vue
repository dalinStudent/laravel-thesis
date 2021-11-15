<template >
	<div>
		<DrawerItem
			routeName="assistant.project"
			text="Project"
			icon="fab fa-vuejs"
		/>
		<DrawerGroupItem
			icon="fas fa-users"
			title="Employee"
		>
			<template #items>
				<DrawerItem
					routeName="assistant.assistant"
					text="Assistant"
					icon="fab fa-user"
				/>
				<DrawerItem
					routeName="assistant.worker"
					text="Worker"
					icon="fab fa-user"
				/>
			</template>
		</DrawerGroupItem>
		<DrawerItem
			routeName="assistant.role"
			text="Role"
			icon="fab fa-vuejs"
		/>
	</div>
</template>
<script>
import DrawerItem from '../../../components/Drawer/Item';
import DrawerGroupItem from '../../../components/Drawer/GroupItem'
export default {
	components: {
		DrawerItem,
		DrawerGroupItem
	},
}
</script>