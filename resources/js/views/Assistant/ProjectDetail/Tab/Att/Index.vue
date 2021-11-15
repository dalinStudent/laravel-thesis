<template>
    <div>
        <Attendance :periodID="periodID"/>
    </div>
</template>
<script>
import Attendance from '@Common/ProjectDetail/Att/Index'
export default {
    components: {
        Attendance
    },
    props: {
        periodID: {
            required: true
        }
    }
}
</script>