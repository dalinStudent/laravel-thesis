<template>
    <div>
        <div class="my-table">
            <table>
                <thead>
					<tr>
                        <td rowspan="2">
                            <v-row justify="center" class="m-0 p-0">
                                <v-checkbox @change="onCheckAllClick" :value="isCheckAllCheck"/>
                            </v-row>
                        </td>
                        <td rowspan="2">ID</td>
						<td rowspan="2">Name</td>
						<td rowspan="2">Date</td>
                        <td rowspan="2">Wage/H( ៛ )</td>
						<td colspan="2">Morning</td>
						<td colspan="2">Afternoon</td>
                        <td colspan="2">Overtime</td>
                        <td colspan="2">Duration( h )</td>
                        <td colspan="2">With Rate( h )</td>
                        <td colspan="2">Amount( ៛ )</td>
                        <td rowspan="2">Total ( ៛ )</td>
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
                        <td>NT</td>
                        <td>OT</td>
                    </tr>
				</thead>
				<tbody>
					<tr v-for="(item,index) in attendances" :key="index">
                        <td>
                            <v-row justify="center" v-if="item.status == 'editable'">
                                <v-checkbox :value="item.id" v-model="checkedID"/>
                            </v-row>
                        </td>
                        <td>{{ item.local_id }}</td>
						<td>{{ item.name }}</td>
						<td>{{ item.date }}</td>
						<td>{{ item.wage_hour }}</td>
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
                        <td>{{ item.nt_amount }}</td>
                        <td>{{ item.ot_amount }}</td>
                        <td>{{ item.total_amount }}</td>
						<td>
                            <v-btn
                                v-if="item.status == 'editable'"
								class="mx-1"
								icon
								color="warning"
								outlined
                                @click="onEditClick(item)"
							>
								<i class="fas fa-edit"></i>
							</v-btn>
                            <v-btn
                                v-else
								class="mx-1"
								icon
                                disabled
								color="red"
								outlined
							>
								<i class="fas fa-lock"></i>
							</v-btn>
						</td>
					</tr>
                    <tr>
                        <td colspan="10" class="p-3">Grand Total</td>
                        <td>{{ total.nt }}</td>
                        <td>{{ total.ot }}</td>
                        <td>{{ total.nt_x_rate }}</td>
                        <td>{{ total.ot_x_rate }}</td>
                        <td>{{ total.nt_amount }}</td>
                        <td>{{ total.ot_amount }}</td>
                        <td class="red text-white">{{ total.total_amount }}</td>
                        <td></td>
					</tr>
				</tbody>
            </table>
        </div>
        <Edit ref="edit"/>
    </div>
</template>
<script>
import  Edit from './Edit'
export default {
    components: {
        Edit
    },
    props: {
        periodID: {
            required: true
        },
        date: {
            required: true
        }
    },
    computed: {
        isCheckAllCheck() {
            this.$emit('check-box-click', this.checkedID);
            return this.checkedID.length == this.attendances.length
        }
    },
    data() {
        return {
            attendances: [],
            checkedID: [],
            total: {
                duration: {
                    nt_x_rate: 0,
                    ot_x_rate: 0
                },
                amount: {
                    nt: 0,
                    ot: 0
                },
                total: 0
            }
        }
    },
    mounted() {
        this.init()
    },
    methods: {
        init(text) {
            var date = text ? text : this.date
            this.$chttp.get('attendance/'+this.periodID, {date: date}).then( res => {
                this.attendances = res.data.data.attendances
                this.total = res.data.data.total
            })
        },
        onCheckAllClick(val) {
            this.checkedID = []
            if (val) {
                this.attendances.forEach( el => {
                    if (el.status == "editable") {
                        this.checkedID.push(el.id)
                    }
                })
            }
        },
        onEditClick(item) {
            this.$refs.edit.init(item)
        }
    },
}
</script>