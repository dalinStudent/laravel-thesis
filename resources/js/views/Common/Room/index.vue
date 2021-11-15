<template>
    <div>
        <TemplateA
        v-model="isShow"
        title="List of Room"
        >      
            <template #action>
				<v-btn 
					color="primary"
					@click="isCreateShow = true"
                    
				>
					Create
				</v-btn>
			</template>
            <template #body>
                <DataTable
					@change="onDataTableChange"
					:filters="filters"
					:columns="columns"
					:data="rooms"
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
					</template>
					<template #action="{item}">
						<v-btn
                                        class="mx-1"
                                        icon
                                        color="warning"
                                        outlined
                                        @click="editClick(item)"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </v-btn>
                                       <v-btn
                                        class="mx-1"
                                        icon
                                        color="warning"
                                        outlined
                                        @click="onDeleteClick(item)"
                                    >
                                        <i class="fas fa-trash"></i>
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
// import Edit from './Edit'
import CreateModal from './Modal/Create';
import EditModal from './Modal/Edit';
export default {
    components: {
		CreateModal,
		EditModal
	},
    props:{
		isShow: {
			type: Boolean,
			default: false
		}
	},
    data() {
        return {
            filters: {
				page: 1,
				per_page: 20
			},
            isCreateShow: false,
			isRemoveShow: false,
			isEditShow: false,
			selectedItem: {},
            isConfirmDelete: false,
            rooms: {
                data: [],
                    meta: {
                        paginate: {
                            total: 0,
                            count: 0,
                            per_page: 0,
                            current_page: 0,
                            total_pages: 0
                        }
                    }
            },
            filters: {
				keyword: null
			},
            columns: [
                {
                    key: 'id',
                    label: 'ID'
                },  
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

    /// life circle 
   
    mounted() {
        this.init()
    },

    methods: {

         onDataTableChange(val) {
            this.filters = val
            this.init()
        },
        init() {
            this.$chttp.get('room', this.filters).then( res => {
                 this.rooms = res.data.data.rooms
                // this.rooms.data = res.data
                // console.log(res);
            })
        },
        
        onAddRoomClick() {
            this.$router.push({
                name: 'admin.room.create'
            })
        },
        onDeleteClick(item) {
            this.selectedItem = item
            this.isConfirmDelete = true
        },
        onConfirmDelete() {
            this.$chttp.delete('room/'+this.selectedItem.id).then( res => {
                this.isConfirmDelete = false
                this.init()
                // console.log(res);
            })
        },
       
        editClick(item) {
			this.isEditShow = true
			this.selectedItem = item
		},
    },
}
</script>



