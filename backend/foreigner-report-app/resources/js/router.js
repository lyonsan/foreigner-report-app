import Vue from 'vue';
import VueRouter from 'vue-router';
import Login from './components/login/Login.vue';
import Home from './components/common/Home.vue';
import ChildMain from './components/child/Main.vue';
import ChildReport from './components/child/Report.vue';
import ChildPareMake from './components/child/PareMake.vue';
import ParentMain from './components/parent/Main.vue';
import ParentReport from './components/parent/Report.vue';
import ParentCommunicate from './components/parent/communicate.vue';
import TeacherMain from './components/teacher/Main.vue';
import TeacherReport from './components/teacher/Report.vue';
import TeacherCommunicate from './components/teacher/communicate.vue';
import SystemError from './components/errors/System.vue';
import store from './store';

Vue.use(VueRouter);


const routes = [
  {
    path:'/login',
    name: 'login',
    component: Login,
    beforeEnter (to, from ,next) {
      if (store.getters['auth/check']) {
        next('/')
      } else {
        next()
      }
    }
  },
  {
    path: '/',
    name: 'home',
    component: Home,
    beforeEnter (to, from ,next) {
      if (store.getters['auth/check']) {
        next()
      } else {
        next('/login')
      }
    }
  },
  {
    path:'/child/main',
    name: 'child.main',
    component: ChildMain
  },
  {
    path:'/child/report',
    name: 'child.report',
    component: ChildReport
  },
  {
    path:'/child/pare-make',
    name: 'child.pareMake',
    component: ChildPareMake
  },
  {
    path:'/parent/main',
    name: 'parent.main',
    component: ParentMain
  },
  {
    path:'/parent/report',
    name: 'parent.report',
    component: ParentReport
  },
  {
    path:'/parent/communicate',
    name: 'parent.communicate',
    component: ParentCommunicate
  },
  {
    path:'/teacher/main',
    name: 'teacher.main',
    component: TeacherMain
  },
  {
    path:'/teacher/report',
    name: 'teacher.report',
    component: TeacherReport
  },
  {
    path:'/teacher/communicate',
    name: 'teacher.communicate',
    component: TeacherCommunicate
  },
  {
    path:'/500',
    component: SystemError
  }
]

const router = new VueRouter({
  mode: 'history',
  routes
})

export default router;