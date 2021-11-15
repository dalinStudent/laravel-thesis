<template>
    <div>
        <TemplateA
            title="Employee Card"
            v-show="!isPrint"
        >
            <template #action>
                <v-btn 
                    color="success"
                    class="mr-2"
                    @click="onPrintClick()"
                >
                    Print
                </v-btn>
                <v-btn 
                    color="primary"
                    @click="onCardSettingClick()"
                >
                    Card Setting
                </v-btn>
            </template>
            <template #body>
                <v-row>
                    <div v-for="(item,index) in printCards" :key="index" class="print-item">
                        {{item.employee.name}}
                        <v-icon
                            color="red"
                            right
                            @click="removePrintItem(index)"
                        >
                            fas fa-times
                        </v-icon>
                    </div>
                </v-row>
                <Card
                    ref="cardlist"
                    :data="data"
                    :setting="setting"
                    @onCardClick="onCardClick"
                />
            </template>
        </TemplateA>
        <Setting ref="setting"/>
        <div v-show="isPrint" class="print-area">
            <Card
                :data="printCards"
                :setting="setting"
            />
        </div>
    </div>
</template>
<script>
import Setting from './Setting'
import Card from './Card'
export default {
    components: {
        Setting,
        Card
    },
    props: {
        data: {
            type: Array,
            default: []
        }
    },
    data() {
        return {
            isPrint: false,
            printCards: [],
            filters: {
                keyword: null,
                project_id: this.$route.params.id,
                role_id: null,
                status: 'work',
                page: 1,
                per_page: 20
            },
            setting: {}
        }
    },
    created() {
        this.init()
    },
    methods: {
        init() {
            this.$chttp.get('setting/card/'+this.$route.params.id).then( res => {
                this.setting = res.data.data.card_setting
            })
        },
        onCardSettingClick() {
            this.$refs.setting.init(Object.assign({}, this.setting))
        },
        onCardClick(item) {
            this.printCards.push(item)
        },
        removePrintItem(index) {
            this.printCards.splice(index, 1);
        },
        async onPrintClick() {
            this.isPrint = true
            await this.$store.commit('setDrawerState', false)
            await this.$store.commit('setNavBarState', false)
            window.print();
            this.isPrint = false
            this.$store.commit('setDrawerState', true)
            this.$store.commit('setNavBarState', true)
        }
    },
}
</script>