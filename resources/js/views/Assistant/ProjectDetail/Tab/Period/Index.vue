<template>
    <Attendance @on-period-detail-click="onClick"/>
</template>
<script>
import Attendance from '@Common/ProjectDetail/Period/Index'
export default {
    components: {
        Attendance
    },
    methods: {
        onClick(item) {
            this.$emit('on-period-detail-click', item)
        }
    },

}
</script>