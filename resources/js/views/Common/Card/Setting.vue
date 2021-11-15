<template>
    <div>
        <v-dialog
            v-model="isShow"
            width="1200px"
            scrollable
            persistent
        >
            <v-card>
                <v-card-title class="headline base-bg-1">
                    Card Setting
                </v-card-title>

                <v-card-text class="p-3">
                    <v-row class="card-setting ma-0 mt-5">
                        <v-col cols="4" class="input pl-0">
                            <v-expansion-panels>
                                <v-expansion-panel>
                                    <v-expansion-panel-header>
                                        Card
                                    </v-expansion-panel-header>
                                    <v-expansion-panel-content>
                                        <v-text-field
                                            outlined
                                            dense
                                            v-model="setting.card_width"
                                            type="number"
                                            prefix="cm"
                                            label="Width"
                                        />
                                        <v-text-field
                                            outlined
                                            type="number"
                                            dense
                                            v-model="setting.card_height"
                                            label="Height"
                                            prefix="cm"
                                        />
                                        <v-text-field
                                            outlined
                                            type="number"
                                            dense
                                            v-model="setting.card_border_weight"
                                            label="Border Weight"
                                            prefix="px"
                                        />
                                        <v-text-field
                                            outlined
                                            type="color"
                                            dense
                                            v-model="setting.card_border_color"
                                            label="Border Color"
                                        />
                                        <v-text-field
                                            outlined
                                            type="number"
                                            dense
                                            v-model="setting.card_border_radius"
                                            label="Border Radius"
                                            prefix="px"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Margin Top"
                                            prefix="px"
                                            type="number"
                                            v-model="setting.card_margin_top"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Margin Right"
                                            prefix="px"
                                            type="number"
                                            v-model="setting.card_margin_right"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Margin Bottom"
                                            prefix="px"
                                            type="number"
                                            v-model="setting.card_margin_bottom"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            prefix="px"
                                            label="Margin Left"
                                            type="number"
                                            v-model="setting.card_margin_left"
                                        />
                                        <div class="col col-12 p-0">
                                            <InputFile
                                                @change="backgroundChange"
                                                @reset="backgroundReset"
                                                truncateLength="15"
                                                :value.sync="photo"
                                                :error="false"
                                                messages=""
                                                :rules="[]"
                                            />
                                        </div>
                                    </v-expansion-panel-content>
                                </v-expansion-panel>
                                <v-expansion-panel>
                                    <v-expansion-panel-header>
                                        ID
                                    </v-expansion-panel-header>
                                    <v-expansion-panel-content>
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Font Size"
                                            type="number"
                                            v-model="setting.id_font_size"
                                            prefix="px"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Color"
                                            type="color"
                                            v-model="setting.id_text_color"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Font Weight"
                                            type="number"
                                            prefix="px"
                                            v-model="setting.id_font_weight"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Margin Top"
                                            prefix="px"
                                            type="number"
                                            v-model="setting.id_margin_top"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Margin Left"
                                            prefix="px"
                                            type="number"
                                            v-model="setting.id_margin_left"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Area Color"
                                            type="color"
                                            v-model="setting.id_area_color"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Area Width"
                                            prefix="px"
                                            type="number"
                                            v-model="setting.id_area_width"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Area Height"
                                            prefix="px"
                                            type="number"
                                            v-model="setting.id_area_height"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Area Radius"
                                            prefix="px"
                                            type="number"
                                            v-model="setting.id_area_radius"
                                        />
                                    </v-expansion-panel-content>
                                </v-expansion-panel>
                                <v-expansion-panel>
                                    <v-expansion-panel-header>
                                        Profile
                                    </v-expansion-panel-header>
                                    <v-expansion-panel-content>
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Width"
                                            type="number"
                                            prefix="px"
                                            v-model="setting.profile_width"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Height"
                                            type="number"
                                            prefix="px"
                                            v-model="setting.profile_height"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Border color"
                                            type="color"
                                            v-model="setting.profile_border_color"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Border Weight"
                                            type="number"
                                            prefix="px"
                                            v-model="setting.profile_border_weight"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Border Radius"
                                            type="number"
                                            prefix="px"
                                            v-model="setting.profile_border_radius"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Margin Top"
                                            prefix="px"
                                            type="number"
                                            v-model="setting.profile_margin_top"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Margin Right"
                                            prefix="px"
                                            type="number"
                                            v-model="setting.profile_margin_right"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Margin Bottom"
                                            prefix="px"
                                            type="number"
                                            v-model="setting.profile_margin_bottom"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            prefix="px"
                                            label="Margin Left"
                                            type="number"
                                            v-model="setting.profile_margin_left"
                                        />
                                    </v-expansion-panel-content>
                                </v-expansion-panel>
                                <v-expansion-panel>
                                    <v-expansion-panel-header>
                                        Name
                                    </v-expansion-panel-header>
                                    <v-expansion-panel-content>
                                        <v-select
                                            outlined
                                            :items="fonts"
                                            dense
                                            label="Font Style"
                                            v-model="setting.name_font_family"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Font Size"
                                            prefix="px"
                                            type="number"
                                            v-model="setting.name_font_size"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Color"
                                            type="color"
                                            v-model="setting.name_text_color"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Font Weight"
                                            type="number"
                                            prefix="px"
                                            v-model="setting.name_font_weight"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Margin Top"
                                            prefix="px"
                                            type="number"
                                            v-model="setting.name_margin_top"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Margin Right"
                                            prefix="px"
                                            type="number"
                                            v-model="setting.name_margin_right"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Margin Bottom"
                                            prefix="px"
                                            type="number"
                                            v-model="setting.name_margin_bottom"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            prefix="px"
                                            label="Margin Left"
                                            type="number"
                                            v-model="setting.name_margin_left"
                                        />
                                    </v-expansion-panel-content>
                                </v-expansion-panel>
                                <v-expansion-panel>
                                    <v-expansion-panel-header>
                                        Role
                                    </v-expansion-panel-header>
                                    <v-expansion-panel-content>
                                        <v-select
                                            outlined
                                            :items="fonts"
                                            dense
                                            label="Font Style"
                                            v-model="setting.role_font_family"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Font Size"
                                            prefix="px"
                                            type="number"
                                            v-model="setting.role_font_size"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Color"
                                            type="color"
                                            v-model="setting.role_text_color"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Font Weight"
                                            type="number"
                                            prefix="px"
                                            v-model="setting.role_font_weight"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Margin Top"
                                            prefix="px"
                                            type="number"
                                            v-model="setting.role_margin_top"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Margin Right"
                                            prefix="px"
                                            type="number"
                                            v-model="setting.role_margin_right"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            label="Margin Bottom"
                                            prefix="px"
                                            type="number"
                                            v-model="setting.role_margin_bottom"
                                        />
                                        <v-text-field
                                            outlined
                                            dense
                                            prefix="px"
                                            label="Margin Left"
                                            type="number"
                                            v-model="setting.role_margin_left"
                                        />
                                    </v-expansion-panel-content>
                                </v-expansion-panel>
                            </v-expansion-panels>
                        </v-col>
                        <v-col cols="8" class="layout">
                            <div>
                                <Card
                                    :setting="setting"
                                    :data="[{
                                        local_id: 10,
                                        employee: {
                                            name: 'អ៊ិន វុទ្ធា',
                                            role_name: 'មេការ'
                                        }
                                    }]"
                                />
                            </div>
                        </v-col>
                    </v-row>
                </v-card-text>
                <v-divider class="m-0"/>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn
                        color="error"
                        text
                        @click="isShow = false"
                    >
                        cancel
                    </v-btn>
                    <v-btn
                        color="success"
                        text
                        @click="onSaveClick()"
                    >
                        save
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>
<script>
import InputFile from '@components/Input/File'
import Card from './Card'
export default {
    components: {
        InputFile,
        Card
    },
    data() {
        return {
            isShow: false,
            photo: null,
            oldBackground: null,
            fonts: [
                'KhmerBanteaySreyB',
                'KhmerOSmuol',
                'KhmerOSsiemreap',
                'khmerM1',
                'KhmerOS'
            ],
            setting: {}
        }
    },
    methods: {
        init(setting) {
            this.isShow = true
            this.setting = setting
        },
        backgroundChange(val) {
            this.oldBackground = this.setting.card_background_img
            this.setting.card_background_img = val.file.url
        },
        backgroundReset() {
            this.setting.background_img = this.oldBackground
        },
        onSaveClick() {
            this.setting.background_img_id = this.photo
            this.$chttp.put('setting/card/'+this.$route.params.id, {value: this.setting}).then( () => {
                this.$parent.init()
            })
        }
    },
}
</script>