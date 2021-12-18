import Vue from 'vue'
import VueRouter from 'vue-router'

import My_profile from "../components/views/My_profile.vue";
import Explore_alumni from "../components/views/Explore_alumni.vue";
import Manage_user from "../components/views/Manage_user.vue";

Vue.use(VueRouter)

const routes = [
  { path: "/my_profile", component: My_profile },
  { path: "/explore_alumni", component: Explore_alumni },
  { path: "/manage_user", component: Manage_user },

  { path: "/", redirect: "/my_profile" },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
