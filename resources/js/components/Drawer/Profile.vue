<template>
    <div>
        <v-list-item :to="`/${this.user.role}/profile`">
            <v-list-item-avatar width="80" height="80">
                <v-img :src="user.photo"></v-img>
            </v-list-item-avatar>
            <v-list-item-content class="header">
                <v-list-item-title> {{ user.fullname }} </v-list-item-title>
            </v-list-item-content>
        </v-list-item>
		<v-divider color="red" class="mt-0"/>
    </div>
</template>
<script>
export default {
    mounted() {
        this.user = this.$cookies.get('user').user
    },
    data() {
        return {
            user: {}
        }
    },
}
</script>