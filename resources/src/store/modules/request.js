const request = {
  namespaced: true,
  state: {
    requestorType: ''
  },
  getters: {
    
  },
  mutations: {
    requestorType(state, requestor) {
      state.requestorType = requestor
    }
  },
  actions: {
    requestorType(context, requestor) {
      context.commit('requestorType', requestor);
    }
  }
}

export default request;