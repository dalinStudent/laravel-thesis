<template>
    <div>
        <Schedule
            class="schedule"
            :projectID="projectID"
        />
    </div>
</template>
<style>
    .schedule {
        margin: -24px;
    }
</style>
<script>
import Schedule from '@Common/Schedule/Index'
export default {
    props: {
        projectID: {
            required: true
        }
    },
    components: {
        Schedule
    }
}
</script>