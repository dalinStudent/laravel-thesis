<template>
    <div>
		<TemplateA
			title="Create User" 
		>
		<!-- :title="userRole == 'assistant' ? 'Company Assistant' : 'Company Side Manager'" -->
			<template #action>
				<v-btn 
					color="primary"
					@click="onAddFromWorkerClick()"
				>
					Create
				</v-btn>
			</template>
			<template #body>
				<DataTable
					:columns="columns"
					:data="users"
				>
					<template #action="{item}">
						<v-btn
							class="mx-1"
							icon
							color="warning"
							outlined
							@click="onEditClick(item)"
						>
							<i class="fas fa-key"></i>
						</v-btn>
						<v-btn
							class="mx-1"
							icon
							color="red"
							outlined
							@click="onRemoveClick(item)"
						>
							<i class="fas fa-times"></i>
						</v-btn>
						<v-btn
							class="mx-1"
							icon
							color="primary"
							outlined
							@click="onMoreClick(item)"
						>
							<i class="fas fa-ellipsis-h"></i>
						</v-btn>
					</template>
				</DataTable>
			</template>
		</TemplateA>
		<ConfirmModal
			:isShow="isConfirmRemoveShow"
			@onCancel="isConfirmRemoveShow=false"
			@onSave="onConfirmRemoveClick"
		/>
		<Edit ref="edit"/>
    </div>
</template>
<script>
import Edit from './Edit'
export default {
	components: {
		Edit
	},
	props: {
		userRole: {
			type: String,
		}
	},
	mounted() {
		this.init()
	},
	data() {
		return {
			isConfirmRemoveShow: false,
			selectedUser: {},
			filter: {
				page: 1
			},
			users: {
				data: [],
				meta: {
					paginate: {}
				}
			},
			columns: [
				{
					key: 'employee.name',
					label: 'Name'
				},
				{
					key: 'employee.role_name',
					label: 'Role'
				},
				{
					key: 'employee.phone_number',
					label: 'Create By'
				}
			]
		}
	},
	methods: {
		init() {
			this.$chttp.get('user', {role: this.userRole}).then( res => {
				this.users = res.data.data.users
			})
		},
		onRemoveClick(item) {
			this.selectedUser = item
			this.isConfirmRemoveShow = true
		},
		onConfirmRemoveClick() {
			this.$chttp.delete('user/'+this.selectedUser.id).then( () => {
				this.isConfirmRemoveShow = false
				this.init()
			})
		},
		onUserClick(item) {
			this.$router.routeTo({
				name: 'worker.detail',
				params: {
					id: item.employee_id
				}
			})
		},
		onAddFromWorkerClick() {
			this.$router.routeTo({
				name: 'user.create',
				query: {
					role: this.userRole
				}
			})
		},
		onEditClick(item) {
			this.$refs.edit.init(item)
		},
		onMoreClick(item) {
			this.$router.routeTo({
				name: 'employee.detail',
				params: {
					id: item.id
				}
			})
		}
	},
	
}
</script>