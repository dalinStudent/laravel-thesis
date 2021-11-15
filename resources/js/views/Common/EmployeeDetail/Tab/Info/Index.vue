<template>
    <div>
        <Photo :data="photos"/>
    </div>
</template>
<script>
import Photo from './Component/Photo'
export default {
    components: {
        Photo
    },
    data() {
        return {
            employee: {},
            wages: [],
            photos: [],
            projects: []
        }
    },
    mounted() {
        this.init()
    },
    methods: {
        init() {
            this.$chttp.get(`employee/${this.$route.params.id}`).then(res => {
                this.employee = res.data.data.employee
                this.wages = res.data.data.wages
                this.photos = res.data.data.photos
                this.projects = res.data.data.projects
                console.log(res.data.data.photos)
            })
        }
    },
}
</script>