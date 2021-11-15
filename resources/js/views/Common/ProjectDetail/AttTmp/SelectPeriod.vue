<template>
	<div>
		<v-dialog persistent v-model="isShow" max-width="500">
            <v-card>
                <v-card-title class="headline base-bg-1">
                    Please select week
                </v-card-title>
                <v-col>
                    <v-select
                        :items="periods"
                        outlined
                        v-model="selectedPeriodID"
                        dense
                        label="Week"
                    />
                </v-col>
                <v-divider class="m-0"/>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="red" text @click="onCancel()">
                        Cancel
                    </v-btn>
                    <v-btn color="green" text @click="onSave()" :disabled="selectedPeriodID == null">
                        Save
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
	</div>
</template>
<script>
export default {
    props: {
        checkedIDs: {
            type: Array,
            default: []
        }
    },
    data() {
        return {
            isShow: false,
            periods: [],
            selectedPeriodID: null
        }
    },
    methods: {
        init(date) {
            this.$chttp.get(`att-tmp/${this.$route.params.id}/show-period`, {date}).then( res => {
                this.isShow = true
                this.periods = res.data.data.periods
            })
        },
        onCancel() {
            this.isShow = false
        },
        onSave() {
            this.$chttp.put(`att-tmp/${this.selectedPeriodID}/accept`, {id: this.checkedIDs}).then( () => {
                this.onCancel()
                this.$parent.init()
            })
        }
    },
}
</script>