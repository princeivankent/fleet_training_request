const request = {
  namespaced: true,
  state: {
    requestorType: '',
    form_steppers: []
  },
  getters: {
    getRequestor(state) {
      return state.requestorType
    },
    getFormSteppers(state) {
      return state.form_steppers
    }
  },
  mutations: {
    requestorType(state, requestor) {
      state.requestorType = requestor
    },
    dealerFormState(state) {
      state.form_steppers = [
        {step: 1, step_name: 'Dealer'},
        {step: 2, step_name: 'Customer'},
        {step: 3, step_name: 'Training'},
        {step: 4, step_name: 'Programs'},
        {step: 5, step_name: 'Isuzu Models'},
        {step: 6, step_name: 'Submit'}
      ]
    },
    customerFormState(state) {
      state.form_steppers = [
        {step: 1, step_name: 'Customer'},
        {step: 2, step_name: 'Training'},
        {step: 3, step_name: 'Programs'},
        {step: 4, step_name: 'Isuzu Models'},
        {step: 5, step_name: 'Submit'}
      ]
    },
  },
  actions: {
    requestorType({commit}, requestor) {
      if (requestor == 'customer') {
        commit('customerFormState')
      } 
      else {
        commit('dealerFormState')
      }

      commit('requestorType', requestor)
    },
    setDealerFormState({commit}) {
      commit('dealerFormState')
    },
    setCustomerFormState({commit}) {
      commit('customerFormState')
    },
  }
}

export default request;