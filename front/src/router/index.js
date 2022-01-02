import Vue from 'vue'
import VueRouter from 'vue-router'
import SignIn_SignUp from '../components/views/SignIn_SignUp.vue'

import My_profile from "../components/views/My_profile.vue";
import Explore_alumni from "../components/views/Explore_alumni.vue";
import Manage_user from "../components/views/Manage_user.vue";
import Event from "../components/views/Event.vue";
import Unauthorized from "../components/nav/Unauthorized.vue";
import Notfound from "../components/nav/Notfound.vue";

Vue.use(VueRouter)

const routes = [
  { path: '/', component: SignIn_SignUp},
  { path: "/my_profile", component: My_profile, meta: { needLogin: true}},
  { path: "/explore_alumni", component: Explore_alumni, meta: { needLogin: true, needEro: true }, },
  { path: "/manage_user", component: Manage_user, meta: { needLogin: true, needAdmin: true }},
  { path: "/host_event", component: Event, meta: { needLogin: true, needEro: true }, },
  { path: "/unauthorized_access", component: Unauthorized},
  { path: "/*", component: Notfound},

  { path: "/my_profile", redirect: "/my_profile" },
]

let authenticationGuard = (to, from, next) => {
  let needLogin = to.meta.needLogin;
  let needAdmin = to.meta.needAdmin;
  let needEro = to.meta.needEro;

  // _______Need Login_______ //
  if (needLogin) {
    if (!localStorage.id) {
      next("/")
    } else {
      if (to.path === '/'){
        next("/my_profile");
      } else {
        next();
      }  
    }
  } else {
    if (localStorage.id) {
      if (to.path === "/") {
        next("/my_profile");
      }
    }
  }

  // ______Need Admin______ //
  if (needAdmin) {
    if (localStorage.getItem('role') === 'Admin') {
      next()
    } else {
        next("/unauthorized_access");
    }
  } else {
    next()
  }

  // ______Need Ero______ //
  if (needEro) {
    if (localStorage.getItem('role') === 'ERO') {
      next()
    } else {
        next("/unauthorized_access");
    }
  }
  next()
}

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach(authenticationGuard);

export default router
