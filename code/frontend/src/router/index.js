import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/private/Home.vue'
import Login from '../views/public/Login.vue'
import Register from '../views/public/Register.vue'
import Board from "../views/private/Board.vue"
import Workspace from "../views/private/Workspace.vue"
import beforeEach from './before-each';
Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/board/:id',
    name: 'Board',
    component: Board,
  },

  
  {
    path: '/workspace/:id',
    name: 'Workspace',
    component: Workspace,
  },

  // Public routes
  {
    path: '/login',
    name: 'Login',
    component: Login,
    meta: {
      public: true
    }
  },
  {
    path: '/register',
    name: 'Register',
    component: Register,
    meta: {
      public: true
    }
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})
const originalPush = VueRouter.prototype.push;
VueRouter.prototype.push = function push(location) {
  return originalPush.call(this, location).catch(err => err);
}
router.beforeEach(beforeEach);
export default router
