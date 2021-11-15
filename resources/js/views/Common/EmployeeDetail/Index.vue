<template>
    <div>
        <TemplateA
            title="Employee Infomation"
        >
            <template #body>
                <v-tabs color="red accent-4" v-model="activeTab">
                    <v-tab>Infomation</v-tab>
                    <v-tab>Attendance</v-tab>
                </v-tabs>
                <v-divider class="mt-0"/>
                <Info v-if="activeTab==0"/>
                <Attendance v-if="activeTab==1"/>
            </template>
        </TemplateA>
    </div>
</template>
<script>
import Info from './Tab/Info/Index';
import Attendance from './Tab/Attendance/Index'
export default {
    components: {
        Info,
        Attendance
    },
    data() {
        return {
            activeTab: 0
        }
    },
}
</script>