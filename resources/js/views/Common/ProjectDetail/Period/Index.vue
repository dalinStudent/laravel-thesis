<template>
    <div>
        <DataTable
            :columns="columns"
            :data="periods"
        >
            <template #right>
                <v-btn 
                    color="primary"
                    @click="onCreateNewWeekClick()"
                >
                    Create New Week
                </v-btn>
            </template>
            <template #action="{item}">
                <v-btn
                    :disabled="item.status != 'open'"
                    class="mx-1"
                    icon
                    color="warning"
                    outlined
                    @click="onEditClick(item)"
                >
                    <i class="fas fa-edit"></i>
                </v-btn>
                <v-btn
                    v-if="item.status == 'open'"
                    class="mx-1"
                    icon
                    color="red"
                    outlined
                    @click="onCloseClick(item)"
                >
                    <i class="fas fa-lock-open"></i>
                </v-btn>
                <v-btn
                    v-else
                    class="mx-1"
                    icon
                    color="red"
                    outlined
                >
                    <i class="fas fa-lock"></i>
                </v-btn>
                <v-btn
                    class="mx-1"
                    :disabled="item.status != 'open'"
                    icon
                    color="red"
                    outlined
                    @click="onRemoveClick(item)"
                >
                    <i class="fas fa-times"></i>
                </v-btn>
                <v-btn
                    class="mx-1"
                    icon
                    color="primary"
                    outlined
                    @click="onMoreClick(item)"
                >
                    <i class="fas fa-ellipsis-h"></i>
                </v-btn>
            </template>
            <template #tfoot-td>
                <td colspan="3">Total</td>
                <td>{{ total }}</td>
                <td></td>
            </template>
        </DataTable>
        <Create ref="create"/>
        <Edit ref="edit"/>
        <ConfirmModal
            :isShow="isRemoveShow"
            @onCancel="isRemoveShow=false"
            @onSave="onSaveRemoveClick()"
        />
        <ConfirmModal
            :isShow="isCloseShow"
            @onCancel="isCloseShow=false"
            @onSave="onSaveCloseClick()"
        />
    </div>
</template>
<script>
import Create from './Create'
import Edit from './Edit'
export default {
    components: {
        Create,
        Edit
    },
    data() {
        return {
            isRemoveShow: false,
            isCloseShow: false,
            periods: {
                data: [],
            },
            selectedPeriod: {},
            total: 0,
            columns: [
                {
                    key: 'name',
                    label: 'Name'
                },
                {
                    key: 'from_date',
                    label: 'From Date'
                },
                {
                    key: 'to_date',
                    label: 'To Date'
                },
                {
                    key: 'total_labor',
                    label: 'Total( ៛ )'
                }
            ]
        }
    },
    mounted() {
        this.init()
    },
    methods: {
        init() {
            this.$chttp.get(`period/${this.$route.params.id}`).then( res => {
                this.periods.data = res.data.data.periods
                this.total = res.data.data.total
            })
        },
        onEditClick(item) {
            this.$refs.edit.init(item)
        },
        onCreateNewWeekClick() {
            this.$refs.create.init()
        },
        onRemoveClick(item) {
            this.selectedPeriod = item
            this.isRemoveShow = true
        },
        onSaveRemoveClick() {
            this.$chttp.delete('period/'+this.selectedPeriod.id).then( ()=> {
                this.isRemoveShow = false
                this.init()
            })
        },
        onCloseClick(item) {
            this.selectedPeriod = item
            this.isCloseShow = true
        },
        onSaveCloseClick() {
            this.$chttp.put(`period/${this.selectedPeriod.id}/close`).then( ()=> {
                this.isCloseShow = false
                this.init()
            })
        },
        onMoreClick(item) {
            this.$emit('on-period-detail-click', item)
        }
    },
}
</script>