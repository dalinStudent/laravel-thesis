<template>
    <div>
        <div class="header">
            <div class="header-left">
                <slot name="left"/>
            </div>
            <div class="header-right">
                <slot name="right"/>
            </div>
        </div>
        <div :class="type">
            <table>
                <thead>
                    <tr>
                        <th v-for="(item, index) in columns" :key="`th-${index}-${item.key}`">
                            {{ item.label }}
                        </th>
                        <slot name="th-action">
                            <th>
                                Action
                            </th>
                        </slot>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in data.data" :key="`row-${index}`">
                        <td v-for="(column, indexCol) in columns" :key="`td-${indexCol}-${column.key}`">
                            <slot :name="column.key" v-bind:item="item">
                                {{ findValueByKey(item, column.key) }}
                            </slot>
                        </td>
                        <td>
                            <slot name="action" v-bind:item="item"/>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <slot name="tfoot-td"/>
                    </tr>
                </tfoot>
            </table>
            <div class="text-center no-result" v-if="data.meta != null && data.meta.paginate.count == 0">
                No Result
            </div>
        </div>
        <div class="footer" v-if="data.meta != null">
            <div class="footer-right w-400">
                <v-pagination
                    color="#ff8f00"
                    @input="onPageChange"
                    :value="data.meta.paginate.current_page"
                    :length="data.meta.paginate.total_pages"
                />
            </div>
            <div class="footer-left">
                <div class="mr-5 mt-3">
                    <p>Total Record: {{data.meta.paginate.total}}</p>
                </div>
                <v-select
                    class="per-page"
                    outlined
                    :value="filters.per_page"
                    @change="onPerpageChange"
                    :items="perPage"
                    dense
                />
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        totalVisible: {
            default: null
        },
        type: {
            type: String,
            default: 'border-tr'
        },
        data: {
            type: Object,
            // requuired: true,
            default() {
                return {
                    data: [],
                    meta: {
                        paginate: {
                            total: 0,
                            count: 0,
                            per_page: 0,
                            current_page: 0,
                            total_pages: 0
                        }
                    }
                }
            }
        },
        columns: {
            type: Array,
            // requuired: true,
            default: [],
        },
        filters: {
            type: Object,
            default() {
                return {
                    per_page: 15,
                    page: 1
                }
            }
        }
    },
    data() {
        return {
            perPage: [
                1,
                20,
                30,
                40,
                50
            ]
        }
    },
    methods: {
        findValueByKey(item, key) {
            var keys = key.split('.')
            var result = item
            keys.forEach(el => {
                result = result[el]
            });
            return result
        },
        onPerpageChange(val) {
            var filters = this.filters
            filters.per_page = val
            filters.page = 1
            this.$emit('change', filters)
        },
        onPageChange(val) {
            var filters = this.filters
            filters.page = val
            this.$emit('change', filters)
        }
    }
}
</script>