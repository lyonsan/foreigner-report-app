import Vue from 'vue';
import VueRouter from 'vue-router';
import Login from './components/login/Login.vue';
import Home from './components/common/Home.vue';
import ChildMain from './components/child/Main.vue';
import ChildReport from './components/child/Report.vue';
import ChildPareMake from './components/child/PareMake.vue';
import ChildCreateReport from './components/child/CreateReport.vue'
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
    component: ChildMain,
    beforeEnter (to, from ,next) {
      if (store.getters['auth/check']) {
        next()
      } else {
        next('/login')
      }
    }
  },
  {
    path:'/child/report',
    name: 'child.report',
    component: ChildReport,
    beforeEnter (to, from ,next) {
      if (store.getters['auth/check']) {
        next()
      } else {
        next('/login')
      }
    }
  },
  {
    path: '/child/create-report',
    name: 'child.create-report',
    component: ChildCreateReport,
    beforeEnter (to, from ,next) {
      if (store.getters['auth/check']) {
        next()
      } else {
        next('/login')
      }
    }
  },
  {
    path:'/child/pare-make',
    name: 'child.pareMake',
    component: ChildPareMake,
    beforeEnter (to, from ,next) {
      if (store.getters['auth/check']) {
        next()
      } else {
        next('/login')
      }
    }
  },
  {
    path:'/parent/main',
    name: 'parent.main',
    component: ParentMain,
    beforeEnter (to, from ,next) {
      if (store.getters['auth/check']) {
        next()
      } else {
        next('/login')
      }
    }
  },
  {
    path:'/parent/report',
    name: 'parent.report',
    component: ParentReport,
    beforeEnter (to, from ,next) {
      if (store.getters['auth/check']) {
        next()
      } else {
        next('/login')
      }
    }
  },
  {
    path:'/parent/communicate',
    name: 'parent.communicate',
    component: ParentCommunicate,
    beforeEnter (to, from ,next) {
      if (store.getters['auth/check']) {
        next()
      } else {
        next('/login')
      }
    }
  },
  {
    path:'/teacher/main',
    name: 'teacher.main',
    component: TeacherMain,
    beforeEnter (to, from ,next) {
      if (store.getters['auth/check']) {
        next()
      } else {
        next('/login')
      }
    }
  },
  {
    path:'/teacher/report',
    name: 'teacher.report',
    component: TeacherReport,
    beforeEnter (to, from ,next) {
      if (store.getters['auth/check']) {
        next()
      } else {
        next('/login')
      }
    }
  },
  {
    path:'/teacher/communicate',
    name: 'teacher.communicate',
    component: TeacherCommunicate,
    beforeEnter (to, from ,next) {
      if (store.getters['auth/check']) {
        next()
      } else {
        next('/login')
      }
    }
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