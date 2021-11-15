<template>
    <div>
        <v-carousel 
            interval="3000"
            show-arrows-on-hover
            hide-delimiters
        >
            <v-carousel-item
                v-for="(item,i) in data"
                :key="i"
            >
                <v-row
                    class="fill-height"
                    align="center"
                    justify="center"
                >
                    <img :src="item.photo" style="height:500px" @dblclick="markCurrent(item.id)"/>
                    <!-- <div style="position:absolute;bottom:0;right:0">
                        <v-icon dark color="green" v-if="item.is_current">
                            mdi-checkbox-marked-circle
                        </v-icon>
                    </div> -->
                    <!-- <div style="position:absolute;top:0;right:0">
                        <v-btn
                            class="mx-1"
                            icon
                            color="red"
                            outlined
                            @click="removePhoto(item.id)"
                        >
                            <v-icon>mdi-minus</v-icon>
                        </v-btn>
                    </div> -->
                </v-row>
            </v-carousel-item>
        </v-carousel>
    </div>
</template>
<script>
export default {
    props: {
        data: {
            type: Array,
            default: []
        }
    }
}
</script>