import { OK, CREATED, UNPROCESSABLE_ENTITY } from '../util';

const state = {
  user: null,
  apiStatus: null,
  registerErrorMessages: null
}

const getters = {
  check: state => !! state.user,
  role: state => state.user ? state.user.user_role : '',
  name: state => state.user ? state.user.user_name : '',
}

const mutations = {
  setUser (state, user) {
    state.user = user
  },
  setApiStatus (state, status) {
    state.apiStatus = status
  },
  setRegisterErrorMessages (state, messages) {
    state.registerErrorMessages = messages
  }
}

const actions = {
  async register (context, data) {
    context.commit('setApiStatus', null)
    const response = await axios.post('/api/register', data).catch(err => err.response || err)
    if (response.status === CREATED) {
      context.commit('setApiStatus', true)
      // commitメソッドでミューテーションを呼び出し、setUserミューテーションを実行することでuserステートを更新する
      context.commit('setUser', response.data)
      return false
    }
    context.commit('setApiStatus', false)
    if (response.status === UNPROCESSABLE_ENTITY) {
      context.commit('setRegisterErrorMessages', response.data.errors)
    } else {
      context.commit('error/setCode', response.status, { root: true })
    }
  },
  async login (context, data) {
    console.log('authログイン')
    context.commit('setApiStatus', null)
    const response = await axios.post('/api/login', data).catch(err => err.response || err)
    if (response.status === OK) {
      context.commit('setApiStatus', true)
      // commitメソッドでミューテーションを呼び出し、setUserミューテーションを実行することでuserステートを更新する
      context.commit('setUser', response.data)
      return false
    }
    context.commit('setApiStatus', false)
    if (response.status === UNPROCESSABLE_ENTITY) {
      context.commit('setLoginErrorMessages', response.data.errors)
    } else {
      context.commit('error/setCode', response.status, { root: true })
    }
  },
  async logout (context) {
    context.commit('setApiStatus', null)
    const response = await axios.post('/api/logout').catch(err => err.response || err)
    if (response.status === OK) {
      context.commit('setApiStatus', true)
      context.commit('setUser', null)
      return false
    }

    context.commit('setApiStatus', false)
    context.commit('error/setCode', response.status, { root: true })
  },
  async currentUser(context) {
    console.log('currentUser')
    const response = await axios.get('/api/user')
    const user = response.data || null
    if (response.status === OK) {
      context.commit('setApiStatus', true)
      context.commit('setUser', user)
      return false
    }
    context.commit('setApiStatus', null)
    context.commit('error/setCode', response.status, { root: true })
  }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}