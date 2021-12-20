<template>
  <v-app>
    <v-navigation-drawer app v-model="showNavigation" absolute bottom temporary>
      <app-nav @logout="logOut">
      </app-nav>
    </v-navigation-drawer>
    <v-app-bar app dark color="blue" v-if="user != null">
      <v-app-bar-nav-icon
        @click.prevent="showNavigation = !showNavigation"
      ></v-app-bar-nav-icon>
      <v-toolbar-title>ALUMNI - BOOK</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn
          :to="{ path: '/my_profile' }"
          class="mr-3"
          color="blue darken-2"
      >
          <v-icon left >mdi-account-multiple</v-icon>
          My Profile
      </v-btn>
      <v-btn
          :to="{ path: '/explore_alumni' }"
          class="mr-3"
          color="blue darken-2"
      >
          <v-icon left >mdi-school</v-icon>
          Explore Alumni
      </v-btn>
      <v-btn
          :to="{ path: '/manage_user' }"
          class="mr-3"
          color="blue darken-2"
      >
          <v-icon left >mdi-account-star</v-icon>
          Manage User
      </v-btn>
    </v-app-bar>
    <v-main>
      <v-container fluid>
        <router-view @signin="logIn"></router-view>
      </v-container>
    </v-main>
    <v-footer app> </v-footer>
  </v-app>
</template>

<script>
import Navigation from './components/nav/Navigation.vue';
import axios from './axios-http';
export default {
  name: 'App',
  components: {
    'app-nav': Navigation,
  },
  data() {
    return {
      showNavigation: false,
      user: null
    };
  },
  methods: {
    // ______________________LOGIN________________________ //
    logIn(users){
      axios.post('login', users)
        .then(res => {
          this.user = res.data.user.firstName + ' ' + res.data.user.lastName;
          localStorage.setItem('Admin', this.user);
          this.$router.push('/My_profile');
        })
        .catch(error => {
          console.log(error.response);
        });
    },
    // ______________________LOGOUT_______________________ //
    logOut(){
      this.user = null;
      this.$router.push('/');
    }
  },
  mounted(){
    if(localStorage.Admin){
      this.user = localStorage.getItem('Admin');
    }
  }
};
</script>