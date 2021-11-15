<template>
    <div>
        <div class="my-table">
            <table>
                <thead>
					<tr>
                        <td rowspan="2">ID</td>
						<td rowspan="2">Name</td>
                        <td rowspan="2">Role</td>
                        <td v-for="date in data.dates" :key="date" colspan="2" class="p-3">
                            {{ date }}
                        </td>
                        <td colspan="2">Duration( h )</td>
                        <td colspan="2">Amount( ៛ )</td>
                        <td rowspan="2">Total( ៛ )</td>
                        <td rowspan="2">Total( $ )</td>
                        <td rowspan="2">Status</td>
					</tr>
                    <tr>
                        <template v-for="(date) in data.dates">
                        <td :key="`${date}-nt`">NT</td>
                        <td :key="`${date}-ot`">OT</td>
                        </template>
                        <td>NT</td>
                        <td>OT</td>
                        <td>NT</td>
                        <td>OT</td>
                    </tr>
				</thead>
				<tbody>
					<tr v-for="(item,index) in data.data" :key="index">
						<td class="p-3">{{ item.local_id }}</td>
						<td>{{ item.name }}</td>
						<td>{{ item.role_name }}</td>
                        <template v-for="(data, index) in item.data">
                        <td :key="`${data.nt_x_rate}-nt-${index}`">{{ data.nt_x_rate }}</td>
                        <td :key="`${data.ot_x_rate}-ot-${index}`">{{ data.ot_x_rate }}</td>
                        </template>
						<td>{{ item.nt_x_rate }}</td>
                        <td>{{ item.ot_x_rate }}</td>
                        <td>{{ item.nt_amount }}</td>
                        <td>{{ item.ot_amount }}</td>
                        <td>{{ item.total_r }}</td>
                        <td>{{ item.total_usd }}</td>
                        <td>
                            <v-chip
                                v-if="item.status == 'paid'"
                                class="ma-2"
                                color="success"
                                label
                            >
                                Paid
                            </v-chip>
                            <v-chip
                                v-else
                                class="ma-2"
                                color="light"
                                @click="confirmShow(item)"
                                label
                            >
                                Unpaid
                            </v-chip>
                        </td>
					</tr>
                    <tr>
                        <td :colspan="(data.dates.length * 2) + 3" class="p-3">Grand Total</td>
                        <td>{{ data.total.nt_x_rate }}</td>
                        <td>{{ data.total.ot_x_rate }}</td>
                        <td>{{ data.total.nt_amount }}</td>
                        <td>{{ data.total.ot_amount }}</td>
                        <td class="red text-white">{{ data.total.total_r }}</td>
                        <td class="red text-white">{{ data.total.total_usd }}</td>
					</tr>
				</tbody>
            </table>
        </div>
        <ConfirmModal
            title="Are you sure want to paid ?"
            btnSaveTitle="yes"
            :isShow="isConfirmShow"
            @onCancel="isConfirmShow=false"
            @onSave="onStatusClick()"
        />
    </div>
</template>
<script>
export default {
    props: {
        periodID: {
            required: true
        }
    },
    data() {
        return {
            isConfirmShow: false,
            selectedItem: {},
            data: {
                dates: [],
                data: [],
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
        }
    },
    mounted() {
        this.init()
    },
    methods: {
        init() {
            this.$chttp.get(`attendance/${this.periodID}/total`).then( res => {
                this.data = res.data.data
            })
        },
        confirmShow(item) {
            this.isConfirmShow = true
            this.selectedItem = item
        },
        onStatusClick() {
            this.$chttp.put(`attendance/${this.selectedItem.period_payment_id}/paid`).then( ()=> {
                this.isConfirmShow = false
                this.init()
            })
        }
    },
}
</script>