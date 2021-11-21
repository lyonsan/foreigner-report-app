import { OK } from '../util';

const state = {
  user: null,
  apiStatus: null
}

const getters = {
  check: state => !! state.user,
  role: state => state.user ? state.user.user_role : ''
}

const mutations = {
  setUser (state, user) {
    state.user = user
  },
  setApiStatus (state, status) {
    state.apiStatus = status
  }
}

const actions = {
  async register (context, data) {
    const response = await axios.post('/api/register', data)
    // commitメソッドでミューテーションを呼び出し、setUserミューテーションを実行することでuserステートを更新する
    context.commit('setUser', response.data)
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
    context.commit('error/setCode', response.status, { root: true })
  },
  async logout (context) {
    const response = await axios.post('/api/logout')
    context.commit('setUser', null)
  },
  async currentUser(context) {
    console.log('currentUser')
    const response = await axios.get('/api/user')
    console.log(response.data);
    const user = response.data || null
    context.commit('setUser', user)
  }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}