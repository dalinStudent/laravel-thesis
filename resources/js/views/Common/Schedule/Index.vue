<template>
    <div>
        <TemplateA
            :title=" projectID == null ? 'Company Schedule' : null"
        >  
            <template #body>
                <div class="my-table">
                    <table>
                        <thead>
                            <tr>
                                <td rowspan="2">Name</td>
                                <td colspan="2">Morning</td>
                                <td colspan="2">Afternoon</td>
                                <td colspan="2">Overtime</td>
                                <td colspan="2">Rate</td>
                                <td rowspan="2">Action</td>
                            </tr>
                            <tr>
                                <td>In</td>
                                <td>Out</td>
                                <td>In</td>
                                <td>Out</td>
                                <td>In</td>
                                <td>Out</td>
                                <td>NT</td>
                                <td>OT</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item,index) in schedules" :key="index">
                                <td>{{ item.name }}</td>
                                <td>{{ item.p1_in }}</td>
                                <td>{{ item.p1_out }}</td>
                                <td>{{ item.p2_in }}</td>
                                <td>{{ item.p2_out }}</td>
                                <td>{{ item.p3_in }}</td>
                                <td>{{ item.p3_out }}</td>
                                <td>x {{ item.nt_rate }}</td>
                                <td>x {{ item.ot_rate }}</td>
                                <td>
                                    <v-btn
                                        class="mx-1"
                                        icon
                                        color="warning"
                                        outlined
                                        @click="onEditClick(item)"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </v-btn>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </template>
        </TemplateA>
        <Edit ref="editModal" @refresh="init()"/> 
    </div>
</template>
<script>
import Edit from './Edit'
export default {
    props: {
        projectID: {
            default: null
        }
    },
    components: {
        Edit
    },
    data() {
        return {
            schedules: []
        }
    },
    mounted() {
        this.init()
    },
    methods: {
        init() {
            this.$chttp.get('schedule/'+this.projectID).then( res => {
                this.schedules = res.data.data.schedules
            })
        },
        onEditClick(item) {
            this.$refs.editModal.init(item)
        }
    },
}
</script>