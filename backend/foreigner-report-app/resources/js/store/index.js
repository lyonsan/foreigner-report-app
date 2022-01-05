import Vue from 'vue';
import Vuex from 'vuex';
import auth from './auth';
import report from './report';
import error from './error';

Vue.use(Vuex);

const store = new Vuex.Store({
  modules: {
    auth,
    report,
    error
  }
})

export default store