<template>
  <v-app>
    <v-navigation-drawer app v-model="showNavigation" absolute bottom temporary>
      <app-nav>
      </app-nav>
    </v-navigation-drawer>
    <v-app-bar app dark color="blue">
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
        <router-view></router-view>
      </v-container>
    </v-main>
    <v-footer app> </v-footer>
  </v-app>
</template>

<script>
import Navigation from './components/nav/Navigation.vue';
export default {
  components: {
    'app-nav': Navigation,
  },
  data() {
    return {
      showNavigation: false,
    };
  },
};
</script>