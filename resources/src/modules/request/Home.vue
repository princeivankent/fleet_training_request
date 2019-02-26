<template>
  <div>
    <RequestorTypeDialog />

    <v-stepper v-if="this.$store.state.request.requestorType" non-linear v-model="page">
      <v-stepper-header>
        <v-stepper-step 
        v-for="(step, index) in getFormSteppers" :key="index"
        :editable="step1" :complete="page > step.step" :step="`${step.step}`" 
        color="red" edit-icon="$vuetify.icons.complete">
        {{ step.step_name }}
        </v-stepper-step>
          <!-- <v-divider></v-divider> -->
      </v-stepper-header>

      <v-stepper-items>
        <v-stepper-content step="1">
          <DealerForm />
          <v-layout justify-end row>
            <v-btn
            color="red darken-1"
            dark
            >
            <v-icon small>fa fa-check</v-icon>&nbsp;
            Continue
            </v-btn>
          </v-layout>
        </v-stepper-content>
      
        <v-stepper-content step="2">
          <!-- @include('guest.training_information') -->
          <v-layout justify-end row>
            <v-btn
            color="red darken-1"
            dark
            >
            <v-icon small>fa fa-check</v-icon>&nbsp;
            Continue
            </v-btn>
          </v-layout>
      
        </v-stepper-content>
      
        <v-stepper-content step="3">
          <!-- @include('guest.programs_offering') -->
        </v-stepper-content>

        <v-stepper-content step="4">
          <!-- @include('guest.isuzu_models') -->
        </v-stepper-content>

        <v-stepper-content step="5">
          <!-- @include('guest.submit_form') -->
        </v-stepper-content>
      </v-stepper-items>
    </v-stepper>
  </div>
</template>

<script>
import { mapGetters, mapState } from 'vuex'
import RequestorTypeDialog from './dialogs/RequestorTypeDialog'
import DealerForm from './components/DealerForm'

export default {
  name: 'home',
  components: {
    RequestorTypeDialog, DealerForm
  },
  data() {
    return {
      page: 1,
      dialog: false,
      photo_gallery: false,
      drawer: true,
      participants: {},

      // make all false except on step1
      step1: true,
      step2: true,
      step3: true,
      step4: true,
      step5: true,
      step6: true,
      
      // Form
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
      },
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
      'getFormSteppers'
    ]),
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
