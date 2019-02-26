const request = {
  namespaced: true,
  state: {
    requestorType: '',
    form_steppers: [],
    form: {
      company_name: '',
      office_address: '',
      contact_person: '',
      email: '',
      contact_number: '',
      position: '',
      contact_number: '',
      training_date: '',
      training_venue: [],
      training_address: '',
      training_program_id: 0,
      unit_model_id: 0,

      selling_dealer: [],
      unit_models: [],
      training_participants: []
    }
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
    SET_REQUESTOR (state, requestor) {
      state.requestorType = requestor
    },
    SET_DEALER_STATE (state) {
      state.form_steppers = [
        {step: 1, step_name: 'Dealer'},
        {step: 2, step_name: 'Customer'},
        {step: 3, step_name: 'Training'},
        {step: 4, step_name: 'Programs'},
        {step: 5, step_name: 'Isuzu Models'},
        {step: 6, step_name: 'Submit'}
      ]
    },
    SET_CUSTOMER_STATE (state) {
      state.form_steppers = [
        {step: 1, step_name: 'Customer'},
        {step: 2, step_name: 'Training'},
        {step: 3, step_name: 'Programs'},
        {step: 4, step_name: 'Isuzu Models'},
        {step: 5, step_name: 'Submit'}
      ]
    },
    ADD_FORM_DATA (state, payload) {
      Vue.set(state.form, payload.property, payload.value)
    }
  },
  actions: {
    requestorType ({commit}, requestor) {
      if (requestor == 'customer') {
        commit('SET_CUSTOMER_STATE')
      } 
      else {
        commit('SET_DEALER_STATE')
      }

      commit('SET_REQUESTOR', requestor)
    },
    setDealerFormState ({commit}) {
      commit('SET_DEALER_STATE')
    },
    setCustomerFormState ({commit}) {
      commit('SET_CUSTOMER_STATE')
    },
    addFormData ({commit}) {

    }
  }
}

export default request;