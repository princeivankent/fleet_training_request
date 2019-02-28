<template>
  <div>
    <RequestorTypeDialog />
    <v-stepper 
    v-if="this.$store.state.request.requestorType" 
    v-model="page" 
    non-linear
    >
      <v-stepper-header>
        <template
        v-for="(step, index) in getFormSteppers"
        >
          <v-stepper-step 
          :key="step.step"
          :editable="step1" 
          :complete="page > step.step" 
          :step="`${index+1}`" 
          edit-icon="$vuetify.icons.complete"
          color="red" 
          >
            {{ step.step_name }}
          </v-stepper-step>

          <v-divider
            v-if="!index+1"
            :key="`div-${index+1}`"
            vertical
            inset
          ></v-divider>
        </template>
      </v-stepper-header>

      <v-stepper-items>
        <v-stepper-content
        v-for="(step, index) in getFormSteppers" 
        :key="index" 
        :step="step.step"
        >
          <component :is="step.component"></component>
        </v-stepper-content>
      </v-stepper-items>
    </v-stepper>
  </div>
</template>

<script>
import { mapGetters, mapState } from 'vuex'
import RequestorTypeDialog from './dialogs/RequestorTypeDialog'
import DealerForm from './components/DealerForm'
import CustomerForm from './components/CustomerForm'
import TrainingForm from './components/TrainingForm'
import ProgramForm from './components/ProgramForm'
import IsuzuModelForm from './components/IsuzuModelForm'
import SubmitForm from './components/SubmitForm'

export default {
  name: 'home',
  components: {
    RequestorTypeDialog, 
    DealerForm, 
    CustomerForm, 
    TrainingForm, 
    ProgramForm, 
    IsuzuModelForm, 
    SubmitForm
  },
  data() {
    return {
      page: 2,
      dialog: false,
      photo_gallery: false,
      drawer: true,
      participants: {},

      // make all false except on step1
      step1: true,
      step2: false,
      step3: false,
      step4: false,
      step5: false,
      step6: false,
      
      unit_models: [],
      dealers: [],
      training_programs: [],
      images: '',
      selected_unit: 0,
      didNotReadYet: true,
      disabled_dates: [],
      special_trainings: [],
    }
  },
  computed: {
    ...mapGetters('request', [
      'getFormSteppers', 'getRequestor'
    ])
  }
}
</script>

<style scoped>
.raleway {
  color: #636b6f;
  font-family: 'Raleway', sans-serif;
  font-weight: 600;
}
.menu {
  width:170px; 
  text-align:center; 
  float:left; 
  position:relative
}
.menu_label {
  color:#FFFFFF; 
  float:left; 
  position:absolute; 
  top:20px; 
  left:150px;
} 
</style>
