<template>
    <TemplateA
        title="Company Project"
    >
        <template #body>
            <v-tabs color="red accent-4" v-model="activeTab" @change="onTabChange">
                <v-tab>Project Infomation</v-tab>
                <v-tab>Schedule</v-tab>
                <v-tab>Staff</v-tab>
                <v-tab @click="onTabAttClick()">Attendance <span v-if="periodID">&nbsp;/&nbsp;{{ periodID }}</span></v-tab>
                <v-tab>Temporary Attendance</v-tab>
                <v-tab>Sending Attendance</v-tab>
            </v-tabs>
            <v-divider class="mt-0"/>
            <About v-if="activeTab == 0"/>
            <Schedule v-if="activeTab == 1"/>
            <Staff v-if="activeTab == 2"/>
            <Period v-if="periodTab" @on-period-detail-click="onPeriodDetailClick"/>
            <Attendance v-if="attTab" :periodID="periodID"/>
            <AttTmp v-if="activeTab==4"/>
            <Sending v-if="activeTab==5"/>
        </template>
    </TemplateA>
</template>
<script>
import About from './Tab/About/Index';
import Staff from './Tab/Worker/Index';
import Period from './Tab/Period/Index';
import Attendance from './Tab/Att/Index';
import AttTmp from './Tab/AttTmp/Index';
import Schedule from './Tab/Schedule/Index';
import Sending from './Tab/Sending/Index'
export default {
    components: {
        About,
        Staff,
        Period,
        Attendance,
        AttTmp,
        Schedule,
        Sending
    },
    computed: {
        periodTab() {
            if (this.activeTab == 3 && this.periodID == null) {
                return true
            }
            return false
        },
        attTab() {
            if (this.activeTab == 3 && this.periodID != null) {
                return true
            }
            return false
        }
    },
    data() {
        return {
            activeTab: localStorage.getItem('project_detail_active_tap')-0,
            periodID: localStorage.getItem('project_detail_period_id_'+this.$route.params.id)
        }
    },
    methods: {
        onPeriodDetailClick(item) {
            this.periodID = item.id
            localStorage.setItem('project_detail_period_id_'+this.$route.params.id, item.id)
        },
        onTabAttClick() {
            this.periodID = null
            localStorage.removeItem('project_detail_period_id_'+this.$route.params.id)
        },
        onTabChange(val) {
            localStorage.setItem('project_detail_active_tap', val)
        }
    },
}
</script> 