import Vue from 'vue'
import VueRouter from 'vue-router'
import SignIn_SignUp from '../components/views/SignIn_SignUp.vue'

import My_profile from "../components/views/My_profile.vue";
import Explore_alumni from "../components/views/Explore_alumni.vue";
import Manage_user from "../components/views/Manage_user.vue";
import Event from "../components/views/Event.vue";

Vue.use(VueRouter)

const routes = [
  { path: '/', component: SignIn_SignUp},
  { path: "/my_profile", component: My_profile },
  { path: "/explore_alumni", component: Explore_alumni },
  { path: "/manage_user", component: Manage_user },
  { path: "/host_event", component: Event },

  { path: "/", redirect: "/my_profile" },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
