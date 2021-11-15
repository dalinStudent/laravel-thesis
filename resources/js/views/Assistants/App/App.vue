<template>
    <App>
        <template #drawer>
            <Drawer/>
        </template>
    </App>
</template>
<script>
    import Drawer from './Drawer'
    import App from '@components/App'
    export default {
        components: {
            App,
            Drawer
        },
        data () {
            return {
                drawer: true,
            }
        }
    }
</script>