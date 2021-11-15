<template>
    <div>
        <div class="my-table">
            <table>
                <thead>
					<tr>
						<td rowspan="2">Name</td>
						<td rowspan="2">Date</td>
                        <td rowspan="2">Wage</td>
						<td colspan="2">Morning</td>
						<td colspan="2">Afternoon</td>
                        <td colspan="2">Overtim</td>
                        <td colspan="2">Duration</td>
                        <td colspan="2">Amount</td>
                        <td rowspan="2">Total</td>
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
						<td>{{ item.name }}</td>
						<td>{{ item.date }}</td>
						<td>{{ item.wage_hour }}</td>
                        <td>{{ item.p1_in }}</td>
                        <td>{{ item.p1_out }}</td>
                        <td>{{ item.p2_in }}</td>
                        <td>{{ item.p2_out }}</td>
                        <td>{{ item.p3_in }}</td>
                        <td>{{ item.p3_out }}</td>
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
								color="red"
								outlined
							>
								<i class="fas fa-lock-open"></i>
							</v-btn>
                            <v-btn
                                v-if="item.status == 'editable'"
								class="mx-1"
								icon
								color="warning"
								outlined
							>
								<i class="fas fa-edit"></i>
							</v-btn>
                            <v-btn
                                v-if="item.status == 'locked'"
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
				</tbody>
            </table>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            attendances: [],
            filerts: {
                from_date: '',
                to_date: '',
                projet_id: null
            }
        }
    },
    mounted() {
        this.init()
    },
    methods: {
        init() {
            this.$chttp.get(`employee/${this.$route.params.id}/attendance`, this.filerts).then(res => {
                this.attendances = res.data.data.attendances
            })
        }
    },
}
</script>