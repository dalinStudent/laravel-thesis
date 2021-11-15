<template>
    <div>
		<v-divider color="red" />
        <v-list-item class="drawer__item" @click="logout()">
            <v-list-item-icon>
                <v-icon class="icon">fas fa-sign-out-alt</v-icon>
            </v-list-item-icon>
            <v-list-item-content class="title">
                <v-list-item-title>Logout</v-list-item-title>
            </v-list-item-content>
        </v-list-item>
    </div>
</template>
<script>
import Auth from '../../http/auth'
export default {
    methods: {
        logout() {
            Auth.logout()
        }
    }
}
</script>