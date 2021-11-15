<template >
	<div>
		<DrawerItem
			routeName="admin.home"
			text="Home"
			icon="fas fa-home"
		/>
	
		
		<DrawerGroupItem
			icon="fas fa-users"
			title="Product"
		>
			<template #items>
				<DrawerItem
			routeName="admin.product"
			text="Add Product"
			icon="fas fa-hotel"
		/>
				<DrawerItem
					routeName="admin.category"
					text="Category"
					icon=""
				/>
				<!-- <DrawerItem
					routeName="admin.worker"
					text="Worker"
					icon=""
				/> -->
			</template>
		</DrawerGroupItem>
		<DrawerGroupItem
			icon="fas fa-users"
			title="Borrow"
		>
			<template #items>
				<DrawerItem
					routeName="admin.borrowingproduct"
					text="Borrowing"
					icon=""
				/>
				<DrawerItem
					routeName="admin.assistant"
					text="Return"
					icon=""
				/>
				<!-- <DrawerItem
					routeName="admin.worker"
					text="Worker"
					icon=""
				/> -->
			</template>
		</DrawerGroupItem>
		<DrawerGroupItem
			icon="fas fa-users"
			title="Student"
		>
			<template #items>
				<DrawerItem
					routeName="admin.student"
					text="Add Student"
					icon="fas fa-student"
				/>
				
			</template>
		</DrawerGroupItem>
		<!-- <DrawerItem
			routeName="admin.role"
			text="Role"
			icon="fas fa-user-tag"
		/> -->
		<DrawerGroupItem
			icon="fas fa-cogs"
			title="Report"
		>
			<template #items>
				<DrawerItem
					routeName="admin.rptStudent"
					text="List of Student"
					icon=""
				/>
				<DrawerItem
					routeName="admin.worker"
					text="Borrowing"
					icon=""
				/>
				<DrawerItem
					routeName="admin.role"
					text="Return"
					icon=""
				/>
				<DrawerItem
					routeName="admin.room"
					text="Staff List"
					icon=""
				/>
			</template>

			

			
			
		</DrawerGroupItem>
		
		<DrawerGroupItem
			icon="fas fa-cogs"
			title="SchoolInformation"
		>
			<template #items>
				<DrawerItem
					routeName="admin.department"
					text="Department"
					icon=""
				/>
				<DrawerItem
					routeName="admin.user"
					text="User"
					icon=""
				/>
				<DrawerItem
					routeName="admin.employee"
					text="Employee"
					icon=""
				/>
				<DrawerItem
					routeName="admin.room"
					text="Room"
					icon=""
				/>
			</template>

			

			
			
		</DrawerGroupItem>
	</div>
</template>
<script>
import DrawerItem from '../../../components/Drawer/Item'
import DrawerGroupItem from '../../../components/Drawer/GroupItem'
export default {
	components: {
		DrawerItem,
		DrawerGroupItem
	},
}
</script>