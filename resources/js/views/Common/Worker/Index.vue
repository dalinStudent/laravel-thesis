<template>
    <div>
		<TemplateA
			title="Company Worker"
		>
			<template #action>
				<v-btn 
					color="primary"
					@click="onCreateClick()"
				>
					Create
				</v-btn>
				<!-- <v-btn 
                    color="success"
					@click="onCardClick()"
                >
                    View Card
                </v-btn> -->
			</template>
			<template #body>
				<DataTable
					@change="onDataTableChange"
					:filters="filters"
					:columns="columns"
					:data="workers"
				>
					<template #left>
						<v-text-field
							class="w-200 mr-2"
							outlined
							dense
							v-model="filters.keyword"
							@input="init()"
							label="Search Name"
							placeholder="Enter here"
						/>
						<v-select
							class="w-200 mr-2"
							:items="roles"
							v-model="filters.role_id"
							outlined
							@change="init()"
							dense
							placeholder="Choose role"
							label="Role"
						/>
						<v-select
							class="w-200 mr-2"
							:items="statuses"
							v-model="filters.status"
							outlined
							@change="init()"
							dense
							placeholder="Choose Status"
							label="Status"
						/>
					</template>
					<template #action="{item}">
						<v-btn
							v-if="item.status == 'stop'"
							class="mx-1"
							icon
							color="green"
							outlined
							@click="onChangeStatusClick(item)"
						>
							<i class="fas fa-sync"></i>
						</v-btn>
						<v-btn
							v-else
							class="mx-1"
							icon
							color="red"
							outlined
							@click="onChangeStatusClick(item)"
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
			title="Are you sure ?"
			:isShow="isChangeStatusShow"
			@onCancel="isChangeStatusShow=false"
			@onSave="onCofirmChangeStatus"
		/>
    </div>
</template>
<script>
export default {
	data() {
		return {
			isChangeStatusShow: false,
			selectedEmployee: {},
			roles: [],
			statuses: [
				{text: 'Busy & Work', value: ['busy', 'work']},
				{text: 'Busy', value: ['busy']},
                {text: 'Work', value: ['work']},
                {text: 'Stop', value: ['stop']}
            ],
			filters: {
				type: 'worker',
				status: ['busy', 'work'],
				page: 1,
				per_page: 30,
				role_id: null,
				keyword: null
			},
			workers: {
				data: [],
				meta: {
					paginate: {

					}
				}
			},
			columns: [
				{
					key: 'name',
					label: 'Name'
				},
				{
					key: 'role_name',
					label: 'Role'
				},
				{
					key: 'phone_number',
					label: 'Phone Number'
				}
			]
		}
	},
	mounted() {
		this.init()
		this.getRole()
	},
    methods: {
		onDataTableChange(val) {
			this.filters = val
			this.init()
		},
		init() {
			this.$chttp.get('employee', this.filters).then( res => {
				this.workers = res.data.data.employees
				console.log(res.data.data.employees)
			})
		},
		getRole() {
            this.$chttp.get('master/role').then( res => {
				this.roles = res.data.data.roles
                this.roles.push({
                    text: 'All',
                    value: null
                })
			})
        },
		// onCardClick() {
		// 	this.$router.routeTo({
		// 		name: 'worker.card'
		// 	})
		// },
		onChangeStatusClick(item) {
			this.isChangeStatusShow = true
			this.selectedEmployee = item
		},
		onCofirmChangeStatus() {
			this.$chttp.put(`employee/${this.selectedEmployee.id}/status`).then( ()=> {
				this.isChangeStatusShow = false
				this.init()
			})
		},
		onCreateClick() {
			this.$router.routeTo({
				name: 'worker.create'
			})
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