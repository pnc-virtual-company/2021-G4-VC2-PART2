import Vue from 'vue'
import VueRouter from 'vue-router'
import SignIn_SignUp from '../components/views/SignIn_SignUp.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'signin',
    component: SignIn_SignUp
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
