<template>
  <v-layout>
    <v-flex>
      <v-card>
        <v-card-title primary-title>
          <div>
            <h3 class="headline mb-0">Submit Request</h3>
          </div>
        </v-card-title>

        <v-card-text>
          <v-alert
          :value="true"
          color="red lighten-1"
          >
            <p><i class="fa fa-bell"></i>&nbsp; Important Reminders</p>
            <ul>
              <li>Make sure all date given is correct, for this will serve as our guide for your trining request.</li>
              <li>Please check your email regularly for the final notification and training reminders</li>
            </ul>
            <br>
            <p>
              In case you need an update on your request you may contact <strong>Isuzu Training Department</strong><br>
              at <strong>(049) 541-0224 local 346</strong> , Monday to Friday, 7:30 A.M - 5:45 P.M and look for <strong>Ms. Clarissa Manimtim</strong>.
            </p>
          </v-alert>
        </v-card-text>

        <v-layout justify-end row>
          <v-btn 
          @click="back"
          >
            <v-icon small>fa fa-arrow-circle-left</v-icon>&nbsp;
            Back
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn 
          @click="submit"
          color="red darken-1" 
          dark
          >
            <v-icon small>fa fa-check-circle</v-icon> &nbsp;
            Submit
          </v-btn>
        </v-layout>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  name: 'Submit',
  methods: {
    submit () {
      console.log('atlast')
    },
    back () {
      this.$store.commit('request/BACK_PAGE')
    }
  }
}
</script>
