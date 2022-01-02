<template>
  <v-list nav dense>
    <v-list-item-group active-class="blue--text text--accent-4">
         <div align="center">
        <v-avatar
          size="120"
          class="profile  mt-4"
        >
          <img :src="userImage" alt="" />
        </v-avatar>
      </div>
     
      <h4 class="d-flex justify-center mt-4 mb-2">{{ userName }}</h4>

      <v-list-item v-show="userRole==='Admin'" :to="{ path: '/my_profile' }">
        <v-list-item-icon>
          <v-icon>mdi-security</v-icon>
        </v-list-item-icon>
        <v-list-item-title>Admin</v-list-item-title>
      </v-list-item>

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

      <v-list-item @click="logOut">
        <v-list-item-icon>
          <v-icon>mdi-exit-to-app</v-icon>
        </v-list-item-icon>
        <v-list-item-title>Sign out</v-list-item-title>
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
    user:null,
    userImage: "https://www.portal.chat/img/avatar.svg",
    userId:localStorage.getItem("id"),
    userRole : localStorage.getItem("role"),
  }),
  methods: {
    // _____________________LOGOUT_____________________ //
    logOut() {
      this.$emit("logout");
    },
    getUser() {
      axios.get("users/" + this.userId).then((res) => {
        this.user = res.data;
        if(this.user.userImage!=null){
            this.userImage = 'http://127.0.0.1:8000/storage/images/users/' + this.user.userImage
        }
      });
    },
  },
  mounted() {
    this.userName = localStorage.getItem("user");
    if(this.userId!=null){
        this.getUser();
    }

  },
};
</script>