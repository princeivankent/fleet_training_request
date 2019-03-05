<template>
  <v-layout>
    <v-flex>
      <v-card>
        <v-card-title primary-title>
          <div>
            <h3 class="headline mb-0">Submit Request</h3>
          </div>
        </v-card-title>

        <v-form>
          <v-container>
            <v-layout align-center>

              <v-flex xs12 md4>
                <label>Isuzu Dealership Name</label>
                <v-text-field
                  solo
                ></v-text-field>
              </v-flex>

              <v-flex md4>
                <label>Name of requester</label>
                <v-text-field
                  solo
                ></v-text-field>
              </v-flex>

            </v-layout>
          </v-container>
        </v-form>

        <v-layout justify-end row>
          <v-btn 
          @click="back"
          color="red darken-1" 
          flat dark
          >
            <v-icon small>fa fa-arrow-circle-left</v-icon>&nbsp;
            Back
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn 
          @click="submit"
          color="red darken-1" 
          flat dark
          >
            Proceed &nbsp;
            <v-icon small>fa fa-arrow-circle-right</v-icon>
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
