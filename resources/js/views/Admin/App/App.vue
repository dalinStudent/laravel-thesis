<template>
    <App>
        <template #drawer>
            <Drawer/>
        </template>
    </App>
</template>
<script>
    import Drawer from './Drawer'
    import App from '../../../components/App'
    export default {
        components: {
            Drawer,
            App
        },
        data () {
            return {
                drawer: true,
            }
        }
    }
</script>