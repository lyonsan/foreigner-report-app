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
  async post() {
    const response = await axios.post('/api/child-report');
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