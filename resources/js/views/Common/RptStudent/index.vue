<template>
    <div>
        <TemplateA title="Report Student">
            <template #action>
                <v-btn color="primary" @click="exportStudent()">
                    Export
                </v-btn>
            </template>
            <template #body>
                <DataTable
                    @change="onDataTableChange"
                    :filters="filters"
                    :columns="columns"
                    :data="students"
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
                        <v-autocomplete
                            :items="items"
                           v-model="filters.name"
                            outlined
                            dense
                            placeholder="Choose role"
                            @change="init()"
                            label="Role"
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
                            color="warning"
                            outlined
                            @click="onDeleteClick(item)"
                        >
                            <i class="fas fa-trash"></i>
                        </v-btn>
                    </template>
                </DataTable>
                <!-- <div class="my-table">
                    <table>
                        <thead>
                            <tr>
                                <td >ID</td>
                                <td >Name</td>
                                 <td >Gender</td>
                                 <td >Department</td>
                                <td >Shift</td>
                                 <td >Year</td>
                                <td >Phonenumber</td>
                                 <td >DOB</td>
                                <td >Living_Location</td>
                               
                                 <td ></td>
                                
                              
                            </tr>
                           
                        </thead>
                        <tbody>
                            <tr v-for="(item,index) in students" :key="index">
                                <td>{{ item.id }}</td>
                                <td>{{ item.name }}</td>
                                <td>{{ item.gender }}</td>
                                <td>{{ item.department_id }}</td>
                                <td>{{ item.shift }}</td>
                                <td>{{ item.year }}</td>
                                <td>{{ item.phonenumber }}</td>
                               <td>{{ item.DOB }}</td>
                               <td>{{ item.Living_Location }}</td>
                                
                            
                             
                                <td>
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
                                        color="warning"
                                        outlined
                                        @click="onEditClick(item)"
                                    >
                                        <i class="fas fa-trash"></i>
                                    </v-btn>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> -->
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
           
            items: [
				{value: 1, text: 'Morning'}
			],
            isConfirmDelete: false,
            students: {
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
                    key: "name",
                    label: "Name"
                },
                {
                    key: "idcard",
                    label: "IDCard"
                },
                {
                    key: "gender",
                    label: "Sex"
                },
                {
                    key: "DOB",
                    label: "Date Of Birth"
                },
                {
                    key: "department_id",
                    label: "Department"
                },
                {
                    key: "shift",
                    label: "Shift"
                },
                {
                    key: "phonenumber1",
                    label: "PhoneNumber1"
                },
                {
                    key: "phonenumber2",
                    label: "PhoneNumber2"
                },

                {
                    key: "Living_Location",
                    label: "Current Location"
                }
            ]
        };
    },

    /// life circle

    mounted() {
        this.getalldeparment();
        this.init();
    },

    methods: {
        onDataTableChange(val) {
            this.filters = val;
            this.init();
        },
        init() {
            this.$chttp.get("student", this.filters).then(res => {
                // console.log(res.data);
                this.students = res.data.data.students;
            });
        },
        getalldeparment() {
            this.$chttp.get("studentexport/getalldepartment").then(res => {
                this.items = res.data.map(res => {
                    return {
                        text: res.name,
                        value: res.id
                    };
                });
                // console.log(res);
            });
        },

        exportStudent() {
            this.$chttp.get("studentexport/").then(res => {
                this.isConfirmDelete = false;
                var fileDownload = require("js-file-download");
                fileDownload(res.data, "StudentList.csv");
                this.init();
                // console.log(res);
            });
        }
    }
};
</script>
