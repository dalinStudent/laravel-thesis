<template>
    <div class="template-a">
        <div class="header" v-if="title">
            <div class="title">
                {{ title }}
            </div>
            <div>
                <slot name="action"/>
            </div>
        </div>
        <div class="body">
            <slot name="body"/>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        title: {
            type: String,
            default: 'title'
        }
    }
}
</script>