<template>
  <div>
    <v-stepper non-linear v-model="page">
      <v-stepper-header>
        <v-stepper-step :editable="step1" :complete="page > 1" step="1" color="red" edit-icon="$vuetify.icons.complete">Dealer</v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step :editable="step2" :complete="page > 2" step="2" color="red" edit-icon="$vuetify.icons.complete">Customer</v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step :editable="step3" :complete="page > 3" step="3" color="red" edit-icon="$vuetify.icons.complete">Training</v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step :editable="step4" :complete="page > 4" step="4" color="red" edit-icon="$vuetify.icons.complete">Programs</v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step :editable="step5" :complete="page > 5" step="5" color="red" edit-icon="$vuetify.icons.complete">Isuzu Models</v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step :editable="step6" :complete="page > 6" step="6" color="red" edit-icon="$vuetify.icons.complete">Submit</v-stepper-step>
      </v-stepper-header>
    </v-stepper>
  </div>
</template>

<script>
export default {
  data() {
    return {
      page: 0,
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
      special_trainings: []
    }
  }
}
</script>

