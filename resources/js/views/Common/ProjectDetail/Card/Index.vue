<template>
    <div>
        <!-- <TemplateA
            title="Employee Card"
        >
            <template #body> -->
        <Card :data="employees.data">
            <!-- <template #filter>
                <v-text-field
                    outlined
                    dense
                    v-model="filters.keyword"
                    @input="init()"
                    label="Search Name"
                    placeholder="Enter here"
                    class="w-300 mr-2"
                />
            </template> -->
        </Card>
            <!-- </template>
        </TemplateA> -->
    </div>
</template>
<script>
import Card from '@Common/Card/Index'
export default {
    components: {
        Card
    },
    data() {
        return {
            employees: {
                data: []
            },
            filters: {
                keyword: null,
                project_id: this.$route.params.id,
                role_id: null,
                status: 'work',
                page: 1,
                per_page: 20
            }
        }
    },
    mounted() {
        this.init()
    },
    methods: {
        init() {
            this.$chttp.get('project-employee', this.filters).then( res => {
                this.employees = res.data.data.employees
            })
        },
    },
}
</script>