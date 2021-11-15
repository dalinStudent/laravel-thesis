<template>
	<div>
		<v-dialog persistent v-model="isShow" max-width="400">
            <v-card>
                <v-card-title :class="`headline ${color[type]}`">
                    {{ title }}
                </v-card-title>
				<v-divider class="m-0"/>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="red" text @click="onCancel()">
                        {{ btnCancelTitle }}
                    </v-btn>
                    <v-btn color="green" text @click="onSave()">
                        {{ btnSaveTitle }}
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
	</div>
</template>
<script>
export default {
    name: 'ConfirmModal',
    props: {
		title: {
			type: String,
			default: 'Are you sure want to delete ?'
		},
		btnCancelTitle: {
			type: String,
			default: 'Cancel'
		},
		btnSaveTitle: {
			type: String,
			default: 'Save'
		},
		type: {
			type: String,
			default: 'success'
		},
		isShow: {
			type: Boolean,
			default: false
		},
    },
    data() {
        return {
            color: {
                success: 'base-bg-1',
                warning: 'base-bg-2'
            }
        }
    },
    methods: {
        onCancel() {
			this.$emit('update:isShow', false)
            this.$emit('onCancel')
        },
        onSave() {
            this.$emit('onSave')
        }
    },
}
</script>