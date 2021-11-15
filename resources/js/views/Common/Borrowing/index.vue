<template>
    <div>
        <TemplateA title="List Of Borrowing">
            <template #action>
                <v-btn color="primary" @click="onAddBorrowingClick()">
                    Add Borrowing
                </v-btn>
            </template>
            <template #body>
                <DataTable
                    @change="onDataTableChange"
                    :filters="filters"
                    :columns="columns"
                    :data="borrowingproducts"
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
                            @click="onEditClick(item)"
                        >
                            <i class="fas fa-edit"></i>
                        </v-btn>
                        <v-btn
                            class="mx-1"
                            icon
                            outlined

                            @click="onUpdateStatus(item)"
                        >
                            R
                            <!-- <i class="fas fa-e dit"></i> -->
                        </v-btn>
                           <v-btn
                            class="mx-1"
                            icon
                            outlined
                            @click="onUpdateCancel(item)"
                        >
                            C
                            <!-- <i class="fas fa-e dit"></i> -->
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
        <ConfirmModal
            :isShow="isConfirmDelete"
            @onCancel="isConfirmDelete = false"
            @onSave="onConfirmDelete()"
        />
        <!-- <Edit ref="editModal" @refresh="init()"/>  -->
    </div>
</template>
<script>
// import Edit from './Edit'
export default {
    // props: {
    //     projectID: {
    //         default: null
    //     }
    // },
    // components: {
    //     Edit
    // },

    data() {
        return {
            filters: {
                page: 1,
                per_page: 20
            },

            isConfirmDelete: false,
            statuses: [
                { text: "Borrowing", value: ["borrowing"] },
                { text: "Return", value: ["return"] },
                { text: "Cancel", value: ["cancel"] }
            ],
            borrowingproducts: {
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
                    key: "id",
                    label: "ID"
                },
                {
                    key: "user_id",
                    label: "StudentName"
                },
                {
                    key: "room_id",
                    label: "Room"
                },
                {
                    key: "product_id",
                    label: "ProductName"
                },
                {
                    key: "qty",
                    label: "Qty"
                },
                {
                    key: "return_qty",
                    label: "Return Qty"
                },
                {
                    key: "start_datetime",
                    label: "StartDatetime"
                },
                {
                    key: "end_datetime",
                    label: "EndDatetime"
                },
                {
                    key: "status",
                    label: "Status"
                }
            ]
        };
    },

    /// life circle

    mounted() {
        this.init();
    },

    methods: {
        onDataTableChange(val) {
            this.filters = val;
            this.init();
        },
        init() {
            this.$chttp.get("borrowingproduct", this.filters).then(res => {
                //  console.log(res.data.data);
                this.borrowingproducts = res.data.data.products;
                // this..data = res.data
            });
        },
        // onEditClick(item) {
        //     this.$refs.editModal.init(item)
        // },
        onEditClick(item) {
            // this.$router.push({name:"admin.student.edit", {params :{id:item.id }}))
            this.$router.push({
                name: "admin.borrowingproduct.edit",
                params: { id: item.id }
            });
        },
        onAddBorrowingClick() {
            this.$router.push({
                name: "admin.borrowingproduct.create"
            });
        },
        onDeleteClick(item) {
            this.selectedItem = item;
            this.isConfirmDelete = true;
        },
        onConfirmDelete() {
            this.$chttp
                .delete("borrowingproduct/" + this.selectedItem.id)
                .then(res => {
                    this.isConfirmDelete = false;
                    this.init();
                    // console.log(res);
                });
        },
        onUpdateStatus(item) {
        
           this.$chttp.put(`borrowingproduct/returnBorrowing/` + item.id, this.borrowingproducts)
                .then(res => {
                    this.$router.back();
                })
                .catch(e => {});
        },
         onUpdateCancel(item) {
           this.$chttp.put(`borrowingproduct/cancelBorrowing/` +item.id,this.borrowingproducts)
                .then(res => {
                    this.$router.back();
                })
                .catch(e => {});
        }
    }
};
</script>
