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
          :to="{ path: '/host_event' }"
          class="mr-3"
          color="blue darken-2"
      >
          <v-icon left >mdi-account-star</v-icon>
          Host Event
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
        <router-view @signin="logIn" @signup="signUp" :error="message_error" :emailError="email_error" :passwordError="password_error"></router-view>
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
      // _____SIGN IN AND SIGN UP______ //
      user: null,
      role: '',
      email: '',
      batch: '',

      // _____MANAGE ERROR______ //
      message_error: '',
      email_error: '',
      password_error: '',

      // _____USER DETAIL______ //
      gender: '',
      DOB: '',
      maritalStatus: '',
      city: '',
      major: '',
      skill: '',
      phoneNumber: ''
    };
  },
  methods: {
    // ______________________LOGIN________________________ //
    logIn(users){
      axios.post('login', users)
        .then(res => {
          this.user = res.data.user.firstName;
          this.email = res.data.user.email;
          localStorage.setItem('user', this.user);
          localStorage.setItem('email', this.email);
          localStorage.setItem('batch', res.data.user.batch);
          this.$router.push('/My_profile');
        })
        .catch(error => {
          this.message_error = error.response.data.message;
          console.log(this.user + ' ' + this.email);
        });
    },
    // ______________________LOGOUT_______________________ //
    logOut(){
      this.user = null;
      localStorage.clear();
      this.$router.push('/');
    },
    // ______________________SIGN UP______________________ //
    signUp(newUsers){
      axios.post('signup', newUsers)
        .then(res => {
          console.log(res.data);
          this.user = res.data.user.firstName + ' ' + res.data.user.lastName;
          this.email = res.data.user.email;
          this.password = res.data.user.password;
          this.role = res.data.user.role;
          this.batch = res.data.user.batch;
          this.$router.push('/my_profile');
          localStorage.setItem('user', this.user);
          localStorage.setItem('email', this.email);
          localStorage.setItem('batch', this.batch);
        })
        .catch(error => {
          this.email_error = error.response.data.errors.email;
          this.password_error = error.response.data.errors.password;
          console.log(error.response.data);
        });
    },
  },
  mounted(){
    if(localStorage.user){
      this.user = localStorage.getItem('user');
    }
  }
};
</script>