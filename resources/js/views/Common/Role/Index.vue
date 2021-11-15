<template>
	<div>
		<TemplateA
			title="Role"
		>
			<template #action>
				<v-btn 
					color="primary"
					@click="isCreateShow = true"
				>
					Create
				</v-btn>
				<v-btn 
					color="primary"
					
				>
					Create Employee
				</v-btn>
			</template>
			<template #body>
				<DataTable
					:columns="columns"
					:data="roles"
					:filters="filters"
					@change="onDataTableChange"
				>
					<template #action="{item}">
						<v-btn
							class="mx-1"
							icon
							color="warning"
							outlined
							@click="editClick(item)"
						>
							<i class="fas fa-pen"></i>
						</v-btn>
						<v-btn
							class="mx-1"
							icon
							color="red"
							outlined
							@click="removeClick(item.id)"
						>
							<i class="fas fa-times"></i>
						</v-btn>
					</template>
				</DataTable>
			</template>
		</TemplateA>
		<CreateModal
			@refresh="init()"
			:isShow.sync="isCreateShow"
		/>
		<EditModal
			@refresh="init()"
			:isShow="isEditShow"
			:data="selectedItem"
		/>
		<ConfirmModal
			:isShow.sync="isRemoveShow"
			btnSaveTitle="YES"
			@onSave="confirmRemove()"
		/>
	</div>
</template>
<script>
import CreateModal from './Modal/Create';
import EditModal from './Modal/Edit';
export default {
	components: {
		CreateModal,
		EditModal
	},
	mounted() {
		this.init()
	},
	data() {
		return {
			isCreateShow: false,
			isRemoveShow: false,
			isEditShow: false,
			selectedID: null,
			selectedItem: {},
			filters: {
				page: 1,
				per_page: 20
			},
			roles:{
				data: [],
				paginate: {
					total: 0,
					count: 0,
					per_page: 0,
					current_page: 0,
					total_pages: 0
				}
			},
			columns: [
				{
					key: 'name',
					label: 'Name'
				},
				{
					key: 'description',
					label: 'Description'
				},
			
			]
		}
	},
	methods: {
		onDataTableChange(val) {
			this.filters = val
			this.init()
		},
		init() {
			this.$chttp.get('role', this.filters).then( res => {
				this.roles = res.data.data.role;
			})
		},
		removeClick(id) {
			this.selectedID = id
			this.isRemoveShow = true
		},
		confirmRemove() {
			this.$chttp.delete('role/'+this.selectedID).then( res => {
				this.isRemoveShow = false
				this.init()
			})
		},
		editClick(item) {
			this.isEditShow = true
			this.selectedItem = item
		},
	},
}
</script>