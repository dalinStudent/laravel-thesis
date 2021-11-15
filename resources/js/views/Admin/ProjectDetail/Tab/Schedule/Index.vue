<template>
    <div>
        <Schedule
            :projectID="$route.params.id"
        />
    </div>
</template>
<script>
import Schedule from '@Common/ProjectDetail/Schedule/Index'
export default {
    components: {
        Schedule
    }
}
</script>