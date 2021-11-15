<template>
    <div>
        <v-row justify="space-between" class="m-0">
            <div style="width:250px!important;margin-top:-3px">
                <v-select
                    :items="dates"
                    outlined
                    v-model="date"
                    @change="onSelectChange"
                    dense
                    label="Option"
                />
            </div>
            <div>
                <v-btn 
                    color="error"
                    @click="isDeleteShow = true"
                    v-if="activeIndex != 0 && date != paysliptPage && date != totalPage"
                    :disabled="attCheckIDs.length == 0"
                >
                    delete
                </v-btn>
                <v-btn 
                    color="primary"
                    @click="onSentClick()"
                    v-if="activeIndex != 0 && date != paysliptPage && date != totalPage"
                    :disabled="attCheckIDs.length == 0"
                >
                    sent
                </v-btn>
                <v-btn 
                    color="primary"
                    @click="onPrintClick()"
                    v-if="date == paysliptPage"
                >
                    Print
                </v-btn>
                <v-btn 
                    color="success"
                    @click="onExportDataClick()"
                >
                    Download
                </v-btn>
            </div>
		</v-row>
        <Total 
            v-if="date == totalPage" 
            :periodID="periodID" 
            ref="total"
        />
        <Payslipt 
            :periodID="periodID"
            v-else-if="date == paysliptPage"
        />
        <Attendance 
            v-else
            :periodID="periodID" 
            :date="date" 
            ref="attendance"
            @check-box-click="onAttendanceCheckBoxClick"
        />
        <ConfirmModal
            :isShow="isDeleteShow"
            @onCancel="isDeleteShow = false"
            @onSave="onDeleteClick()"
        />
        <Sent 
            :attCheckIDs="attCheckIDs" 
            ref="sent"  
            @onSuccess="onSendSuccess()"
        />
    </div>
</template>
<script>
import Attendance from './Att'
import Total from './Total'
import Payslipt from './Payslipt'
import Sent from './Sent'
export default {
    components: {
        Attendance,
        Total,
        Payslipt,
        Sent
    },
    props: {
        periodID: {
            required: true
        }
    },
    data() {
        return {
            activeIndex: 1,
            isDeleteShow: false,
            attCheckIDs: [],
            dates: [],
            totalPage: 'Total',
            paysliptPage: 'Payslipt',
            date: 'ALL'
        }
    },
    mounted() {
        this.init()
    },
    methods: {
        init() {
            this.$chttp.get(`period/${this.periodID}/date-range`).then( res => {
                this.dates.push(this.totalPage)
                this.dates.push(this.paysliptPage)
                this.dates.push('ALL')
                this.dates = this.dates.concat(res.data.data.dates)
            })
        },
        onSendSuccess() {
            this.$refs.attendance.init()
            this.attCheckIDs = []
        },
        // onRefresh() {
        //     if (this.activeIndex) {
        //         this.$refs.attendance.init()
        //     } else {
        //         this.$refs.total.init()
        //     }
        // },
        onExportDataClick() {

        },
        onPrintClick() {

        },
        onSentClick() {
            this.$refs.sent.init()
        },
        onDeleteClick() {
            this.$chttp.delete('attendance', {id: this.attCheckIDs}).then( () => {
                this.isDeleteShow = false
                this.$refs.attendance.init()
                this.attCheckIDs = []
            })
        },
        onAttendanceCheckBoxClick(val) {
            this.attCheckIDs = val
        },
        onSelectChange(text) {
            if (this.$refs.attendance) {
                this.$refs.attendance.init(text)
            }
        },
    },
}
</script>