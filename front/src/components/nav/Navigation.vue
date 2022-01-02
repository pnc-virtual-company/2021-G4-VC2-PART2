<template>
<v-list nav dense>
    <v-list-item-group active-class="blue--text text--accent-4">
        <div align="center">
            <v-avatar size="120" class="profile  mt-4">
                <img :src="userImage" alt="" />
            </v-avatar>
        </div>

        <h4 class="d-flex justify-center mt-4 mb-2">{{ userName }}</h4>

      <v-list-item v-show="userRole==='ERO'" :to="{ path: '/explore_alumni' }">
        <v-list-item-icon>
          <v-icon>mdi-account</v-icon>
        </v-list-item-icon>
        <v-list-item-title>ERO Officer</v-list-item-title>
      </v-list-item>
      <v-list-item v-show="userRole==='Alumni'"   :to="{ path: '/my_profile' }">
        <v-list-item-icon>
          <v-icon>mdi-school</v-icon>
        </v-list-item-icon>
        <v-list-item-title>Alumni</v-list-item-title>
      </v-list-item>

        <v-list-item v-show="userRole==='ERO'" :to="{ path: '/explore_alumni' }">
            <v-list-item-icon>
                <v-icon>mdi-account</v-icon>
            </v-list-item-icon>
            <v-list-item-title>ERO Officer</v-list-item-title>
        </v-list-item>
        <v-list-item v-show="userRole==='Alumni'">
            <v-list-item-icon>
                <v-icon>mdi-school</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Alumni</v-list-item-title>
        </v-list-item>

        <v-list-item>
            <!-- Logout Dialog -->
            <div class="text-center">
                <v-dialog v-model="dialog" width="300">
                    <template v-slot:activator="{ on, attrs }">
                        <div class="d-flex"  v-bind="attrs" v-on="on">
                            <v-list-item-icon>
                                <v-icon>mdi-exit-to-app</v-icon>
                            </v-list-item-icon>
                            <v-list-item-title>Sign out</v-list-item-title>
                        </div>
                    </template>

                    <v-card>
                        <v-card-title class="text-h5 blue white--text">
                            Logging out !
                        </v-card-title>

                        <v-card-text class="mt-4" align="center">
                            Are you sure you want to log out ?
                        </v-card-text>

                        <v-divider></v-divider>

                        <v-card-actions>
                          <v-btn color="red" text @click="dialog = false">
                                Cancel
                            </v-btn>
                            <v-spacer></v-spacer>
                            <v-btn color="primary" text @click="dialog = false; logOut()">
                                Log out
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </div>
            <!-- End Logout Dialog -->
        </v-list-item>
    </v-list-item-group>
</v-list>
</template>

<script>
import axios from "../../axios-http";
export default {
    emits: ["logout"],
    data: () => ({
        userName: "",
        user: null,
        userImage: "https://www.portal.chat/img/avatar.svg",
        userId: localStorage.getItem("id"),
        userRole: localStorage.getItem("role"),
        dialog: false,
    }),
    methods: {
        // _____________________LOGOUT_____________________ //
        logOut() {
            this.$emit("logout");
        },
        getUser() {
            axios.get("users/" + this.userId).then((res) => {
                this.user = res.data;
                if (this.user.userImage != null) {
                    this.userImage = 'http://127.0.0.1:8000/storage/images/users/' + this.user.userImage
                }
            });
        },
    },
    mounted() {
        this.userName = localStorage.getItem("user");
        if (this.userId != null) {
            this.getUser();
        }

    },
};
</script>
