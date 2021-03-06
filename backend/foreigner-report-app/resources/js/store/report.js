import { OK, CREATED,  INTERNAL_SERVER_ERROR } from '../util'

const state = {
  apiStatus: null,
  postErrorMessage: null
}

const mutations = {
  setApiStatus (state, status) {
    state.apiStatus = status
  },
  setPostErrorMessage (state, message) {
    state.postErrorMessage = message
  }
}

const actions = {
  // 投稿を行う
  async post(context, data) {
    context.commit('setApiStatus', null);
    const response = await axios.post('/api/child-report', data).catch(err => err.response || err)
    if (response.status === CREATED) {
      context.commit('setApiStatus', true)
      return false
    }
    context.commit('setApiStatus', false)
    if (response.status === INTERNAL_SERVER_ERROR) {
      context.commit('setPostErrorMessage', response.data.error)
    } else {
      context.commit('error/setCode', response.status, { root: true })
    }
  }
}


export default {
  namespaced: true,
  state,
  mutations,
  actions
}