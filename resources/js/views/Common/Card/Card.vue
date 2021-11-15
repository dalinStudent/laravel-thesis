<template>
    <v-row>
        <div v-for="(item, index) in data" :key="index" class="id-card" :style="card" @click="onCardClick(item)">
            <div class="background-img">
                <img :src="setting.card_background_img" alt="background">
            </div>
            <div class="id-card--info">
                <div class="id" :style="id">
                    {{ item.local_id }}
                </div>
                <div class="profile">
                    <img src="https://cdn.pixabay.com/photo/2018/08/28/12/41/avatar-3637425_960_720.png" :style="profile" alt="profile">
                </div>
                <div class="name" :style="name">
                    {{ item.employee.name }}
                </div>
                <div class="role" :style="role">
                    {{ item.employee.role_name }}
                </div>
            </div>
        </div>
    </v-row>
</template>
<script>
export default {
    props: {
        setting: {
            type: Object,
            default() {
                return {

                }
            }
        },
        data: {
            type: Array,
            default: []
        }
    },
    methods: {
        onCardClick(item) {
            this.$emit('onCardClick', item)
        }
    },
    computed: {
        card() {
            return `
                width:${this.setting.card_width}cm;
                height:${this.setting.card_height}cm;
                border:${this.setting.card_border_weight}px solid ${this.setting.card_border_color};
                border-radius:${this.setting.card_border_radius}px;
                margin-top:${this.setting.card_margin_top}px;
                margin-right: ${this.setting.card_margin_right}px;
                margin-bottom: ${this.setting.card_margin_bottom}px;
                margin-left: ${this.setting.card_margin_left}px;
                overflow:hidden
            `
        },
        id() {
            return `
                font-size:${this.setting.id_font_size}px;
                color: ${this.setting.id_text_color};
                margin-left:${this.setting.id_margin_left}px;
                margin-top:${this.setting.id_margin_top}px;
                font-weight:${this.setting.id_font_weight};
                width:${this.setting.id_area_width}px;
                height:${this.setting.id_area_height}px;
                background-color: ${this.setting.id_area_color};
                border-radius:${this.setting.id_area_radius}px
            `
        },
        profile() {
            return `
                width:${this.setting.profile_width}px;
                height:${this.setting.profile_height}px;
                border:${this.setting.profile_border_weight}px solid ${this.setting.profile_border_color};
                border-radius:${this.setting.profile_border_radius}px;
                margin-top:${this.setting.profile_margin_top}px;
                margin-right: ${this.setting.profile_margin_right}px;
                margin-bottom: ${this.setting.profile_margin_bottom}px;
                margin-left: ${this.setting.profile_margin_left}px;
            `
        },
        name() {
            return `
                font-size:${this.setting.name_font_size}px;
                font-weight:${this.setting.name_font_weight};
                font-family:${this.setting.name_font_family};
                color:${this.setting.name_text_color};
                margin-top:${this.setting.name_margin_top}px;
                margin-right: ${this.setting.name_margin_right}px;
                margin-bottom: ${this.setting.name_margin_bottom}px;
                margin-left: ${this.setting.name_margin_left}px;
            `
        },
        role() {
            return `
                font-size:${this.setting.role_font_size}px;
                font-weight:${this.setting.role_font_weight};
                font-family:${this.setting.role_font_family};
                color:${this.setting.role_text_color};
                margin-top:${this.setting.role_margin_top}px;
                margin-right: ${this.setting.role_margin_right}px;
                margin-bottom: ${this.setting.role_margin_bottom}px;
                margin-left: ${this.setting.role_margin_left}px;
            `
        }
    },
}
</script>