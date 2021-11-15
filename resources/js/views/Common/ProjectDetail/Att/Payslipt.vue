<template>
    <div>
        <div class="payslipt">
            <table>
                <tbody>
                    <template v-for="(item, index) in data">
                        <tr :key="index+ 'project'">
                            <td>Project</td>
                            <td colspan="3">{{ item.project_name }}</td>
                        </tr>
                        <tr :key="index + 'date'">
                            <td>Period Date </td>
                            <td colspan="3">{{ item.date_period }}</td>
                        </tr>
                        <tr :key="index+ 'employee'">
                            <td>Name</td>
                            <td colspan="3">{{ item.employee_name }}</td>
                        </tr>
                        <tr :key="index+'nt'">
                            <td>Normal Time</td>
                            <td>h {{ item.nt_x_rate }}</td>
                            <td>$ {{ item.nt_amount_usd }}</td>
                            <td>៛ {{ item.nt_amount }}</td>
                        </tr>
                        <tr :key="index+'ot'">
                            <td>Overtime</td>
                            <td>h {{ item.ot_x_rate }}</td>
                            <td>$ {{ item.ot_amount_usd }}</td>
                            <td>៛ {{ item.ot_amount }}</td>
                        </tr>
                        <tr :key="index+'total'">
                            <td>Total</td>
                            <td class="total">h {{ item.total_duration }}</td>
                            <td class="total">$ {{ item.total_amount_usd }}</td>
                            <td class="total">៛ {{ item.total_amount_riel }}</td>
                        </tr>
                        <tr :key="index+'foot'">
                            <td colspan="4"/>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
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
            data: []
        }
    },
    mounted() {
        this.init()
    },
    methods: {
        init() {
            this.$chttp.get(`attendance/${this.periodID}/payslipt`).then( res => {
                this.data = res.data.data.period_payments
                console.log(res.data.data)
            })
        },
    },
}
</script>