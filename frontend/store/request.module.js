import ApiService from '../services/api.service'

const request = {
  namespaced: true,
  state: {
    current_page: 6,
    requestorType: '',
    form_steppers: [],
    form: {
      // Customer Info
      company_name: '',
      office_address: '',
      contact_person: '',
      email: '',
      contact_number: '',
      position: '',
      selling_dealer: [],
      unit_model_id: 0,

      selling_dealer: [],
      training_date: '',
      training_venue: '',
      training_address: '',
      training_program_id: 0,
      training_participants: [],
      unit_models: [],

      dealer_info: {
        dealership_name: '',
        requestor_name: '',
        position: '',
        email: '',
        contact: ''
      }
    },
    training_programs: [],
    unit_models: [],
    special_trainings: []
  },
  getters: {
    getRequestor: state => state.requestorType,
    getFormSteppers: state => state.form_steppers,
    requestFormState: state => state.form,
    getImages: (state) => (payload) => {
      const data = state.training_programs.find((item, index) => index === payload)
      return data.images
    }
  },
  mutations: {
    BACK_PAGE (state) {
      state.current_page--
    },
    NEXT_PAGE (state) {
      state.current_page++
    },
    //--> Dynamic Data Bindings from vue component
    UPDATE_FORM (state, payload) {
      state.form[payload.key] = payload.value
    },
    PUSH_FORM (state, payload) {
      state.form[payload.key].push(payload.value)
    },
    SPLICE_FORM (state, payload) {
      state.form[payload.key].splice(payload.value,1)
    },
    //--> end
    SET_REQUESTOR (state, requestor) {
      state.requestorType = requestor
    },
    SET_DEALER_STATE (state) {
      state.form_steppers = [
        {step: 1, step_name: 'Dealer', component: 'DealerForm'},
        {step: 2, step_name: 'Customer', component: 'CustomerForm'},
        {step: 3, step_name: 'Training', component: 'TrainingForm'},
        {step: 4, step_name: 'Programs', component: 'Programs'},
        {step: 5, step_name: 'Isuzu Models', component: 'IsuzuModels'},
        {step: 6, step_name: 'Submit', component: 'Submit'}
      ]
    },
    SET_CUSTOMER_STATE (state) {
      state.form_steppers = [
        {step: 1, step_name: 'Customer', component: 'CustomerForm'},
        {step: 2, step_name: 'Training', component: 'TrainingForm'},
        {step: 3, step_name: 'Programs', component: 'Programs'},
        {step: 4, step_name: 'Isuzu Models', component: 'IsuzuModels'},
        {step: 5, step_name: 'Submit', component: 'Submit'}
      ]
    },
    ADD_FORM_DATA (state, payload) {
      state.form = Object.assign({}, state.form, payload)
    },
    ADD_DEALER_DATA (state, payload) {
      state.form.dealer_info = Object.assign({}, state.form.dealer_info, payload)
    },
    SET_TRAINING_PROGRAMS (state, payload) {
      state.training_programs = payload
    },
    SET_UNIT_MODELS (state, payload) {
      state.unit_models = payload
    },
    SET_SPECIAL_TRAININGS (state, payload) {
      state.special_trainings = payload
    }
  },
  actions: {
    requestorType ({commit}, requestor) {
      if (requestor == 'customer')
        commit('SET_CUSTOMER_STATE')
      else
        commit('SET_DEALER_STATE')

      commit('SET_REQUESTOR', requestor)
    },
    setDealerFormState ({commit}) {
      commit('SET_DEALER_STATE')
    },
    setCustomerFormState ({commit}) {
      commit('SET_CUSTOMER_STATE')
    },
    addFormData ({commit}, payload) {
      commit('ADD_FORM_DATA', payload)
    },
    addDealerData ({commit}, payload) {
      commit('ADD_DEALER_DATA', payload)
    },
    async setTrainingPrograms ({commit}, payload) {
      const {data} = await ApiService.get('guest/training_programs/get')
      commit('SET_TRAINING_PROGRAMS', data)
    },
    async fetchUnitModels ({commit}) {
      const {data} = await ApiService.get('guest/unit_models/get')
      commit('SET_UNIT_MODELS', data)
    },
    async setSpecialTrainings ({commit}) {
      const {data} = await ApiService.get('special_trainings')
      return commit('SET_SPECIAL_TRAININGS', data)
    }
  }
}

export default request;