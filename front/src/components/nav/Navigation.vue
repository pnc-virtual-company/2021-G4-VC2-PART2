<template>
    <v-list nav dense>
        <v-list-item-group active-class="blue--text text--accent-4">
            <div style="margin-left: 26%;">
            <v-img class="rounded-circle" src="../../assets/jennie.jpg" height="120px" width="120px"/>
            </div>
            <h4 class="d-flex justify-center mt-4 mb-2">Malita</h4>

        <v-list-item :to="{ path: '/my_profile' }">
            <v-list-item-icon>
            <v-icon>mdi-security</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Admin</v-list-item-title>
        </v-list-item>
        
        <v-list-item :to="{ path: '/explore_alumni' }">
            <v-list-item-icon>
            <v-icon>mdi-account</v-icon>
            </v-list-item-icon>
            <v-list-item-title>ERO Officer</v-list-item-title>
        </v-list-item>

        <v-list-item :to="{ path: '/manage_user' }">
            <v-list-item-icon>
            <v-icon>mdi-school</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Alumni</v-list-item-title>
        </v-list-item>

        <v-list-item :to="{ path: '/' }">
            <v-list-item-icon>
            <v-icon>mdi-exit-to-app</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Sign out</v-list-item-title>
        </v-list-item>
        </v-list-item-group>
    </v-list>
</template>