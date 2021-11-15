<template>
    <div>
        <div class="header">    
            <div>
                <v-select
                    :items="dates"
                    outlined
                    v-model="filter.date"
                    @change="init()"
                    dense
                    label="Option"
                />
            </div>
            <div>
                <v-btn 
                    color="success"
                    :disabled="checkedIDs.length == 0"
                    @click="onAcceptClick()"
                >
                    accept
                </v-btn>
                <v-btn 
                    color="error"
                    :disabled="checkedIDs.length == 0"
                    @click="onDeleteClick()"
                >
                    Delete
                </v-btn>
                <v-btn 
                    color="primary"
                    @click="onImportDataClick()"
                >
                    Import Data
                </v-btn>
            </div>
        </div>
        <div class="my-table">
            <table>
                <thead>
					<tr>
                        <td rowspan="2">
                            <v-row justify="center" class="m-0 p-0">
                                <v-checkbox @change="onCheckAllChange" :value="isCheckAllChecked" />
                            </v-row>
                        </td>
						<td rowspan="2">Name</td>
						<td rowspan="2">Date</td>
                        <td rowspan="2">Wage/H( ៛ )</td>
						<td colspan="2">Morning</td>
						<td colspan="2">Afternoon</td>
                        <td colspan="2">Overtim</td>
                        <td colspan="2">Duration( h )</td>
                        <td colspan="2">With Rate( h )</td>
                        <td rowspan="2">Total( h )</td>
                        <td rowspan="2">Total( ៛ )</td>
                        <td rowspan="2">Action</td>
					</tr>
                    <tr>
                        <td>In</td>
                        <td>Out</td>
                        <td>In</td>
                        <td>Out</td>
                        <td>In</td>
                        <td>Out</td>
                        <td>NT</td>
                        <td>OT</td>
                        <td>NT</td>
                        <td>OT</td>
                    </tr>
				</thead>
				<tbody>
					<tr v-for="(item,index) in attendances" :key="index">
                        <td>
                            <v-row justify="center">
                                <v-checkbox :value="item.id" v-model="checkedIDs"/>
                            </v-row>
                        </td>
						<td>{{ item.name }}</td>
						<td>{{ item.date }}</td>
                        <td>{{ item.hour }}</td>
                        <td>{{ item.p1_in }}</td>
                        <td>{{ item.p1_out }}</td>
                        <td>{{ item.p2_in }}</td>
                        <td>{{ item.p2_out }}</td>
                        <td>{{ item.p3_in }}</td>
                        <td>{{ item.p3_out }}</td>
                        <td>{{ item.nt }}</td>
                        <td>{{ item.ot }}</td>
                        <td>{{ item.nt_x_rate }}</td>
                        <td>{{ item.ot_x_rate }}</td>
                        <td>{{ item.total_duration }}</td>
                        <td>{{ item.total_amount }}</td>
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
						</td>
					</tr>
				</tbody>
            </table>
            <div class="text-center p-3" v-if="!attendances.length">
				<h1>No result</h1>
			</div>
        </div>
        <SelectPeriod 
            ref="selectPeriod"
            :checkedIDs="checkedIDs"
        />
        <ConfirmModal
            :isShow="isDeleteShow"
            type="warning"
            @onCancel="isDeleteShow=false"
            @onSave="onConfirmDelete()"
        />
        <ImportModal ref="importModal" @refresh="init()"/>
        <EditModal ref="editModal" @refresh="init()"/>
    </div>
</template>
<script>
import EditModal from './Edit'
import ImportModal from './ImportModa'
import SelectPeriod from './SelectPeriod'
export default {
    components: {
        ImportModal,
        EditModal,
        SelectPeriod
    },
    data() {
        return {
            isAcceptShow: false,
            isDeleteShow: false,
            selectedItem: {},
            attendances: [],
            checkedIDs :[],
            dates: [],
            periods: [],
            filter: {
                date: null
            }
        }
    },
    mounted() {
        this.init()
    },
    computed: {
        isCheckAllChecked() {
            if (this.checkedIDs.length) {
                return this.checkedIDs.length == this.attendances.length
            }
            return false
        }
    },
    methods: {
        init() {
            this.$chttp.get('att-tmp/'+this.$route.params.id, this.filter).then( res => {
                this.attendances = res.data.data.attendances
                this.dates = res.data.data.dates
                this.filter.date = res.data.data.date
                this.checkedIDs = []
            })
        },
        onCheckAllChange(val) {
            this.checkedIDs = []
            if (val) {
                this.attendances.forEach( el => {
                    this.checkedIDs.push(el.id)
                })
            }
        },
        onImportDataClick() {
            this.$refs.importModal.init()
        },
        onEditClick(item) {
            this.$refs.editModal.init(item)
        },
        onAcceptClick() {
            this.$refs.selectPeriod.init(this.filter.date)
        },
        onConfrimAccept() {
            this.$chttp.put('att-tmp', {id: this.checkedIDs}).then( () => {
                this.isAcceptShow = false
                this.init()
            })
        },
        onDeleteClick() {
            this.isDeleteShow = true
        },
        onConfirmDelete() {
            this.$chttp.delete('att-tmp', {id: this.checkedIDs}).then( () => {
                this.isDeleteShow = false
                this.init()
            })
        }
    },
}
</script>