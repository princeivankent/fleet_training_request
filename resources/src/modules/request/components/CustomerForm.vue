<template>
  <v-layout>
    <v-flex>
      <v-card>
        <v-form>
          <v-container fluid>
            <v-layout justify-center row wrap>
              <v-flex xs6 sm6>
                <v-text-field
                label="Company Name"
                v-model="company_name"
                @input="$v.company_name.$touch()"
                @blur="$v.company_name.$touch()"
                :error-messages="validation('company_name', 'Company Name')"
                outline
                required
                ></v-text-field>
              </v-flex>
            </v-layout>

            <v-layout justify-center row wrap>
              <v-flex xs6 sm6>
                <!-- <v-text-field
                label="Isuzu Dealership Name"
                v-model="selling_dealer"
                @input="$v.selling_dealer.$touch()"
                @blur="$v.selling_dealer.$touch()"
                :error-messages="nameErrors"
                outline
                required
                ></v-text-field> -->

                <v-select
                v-model="selling_dealer"
                :items="dealers"
                item-text="dealer"
                item-value="dealer_id"
                label="Isuzu Dealership Name"
                deletable-chips
                chips
                color="red"
                search-input
                multiple
                outline
                required
                @blur="updateSelection"
                >
                </v-select>
              </v-flex>
            </v-layout>

            <v-layout justify-center row wrap>
              <v-flex xs6 sm3>
                <v-text-field
                label="Name of requester"
                outline
                ></v-text-field>
              </v-flex>

              <v-flex xs12 sm3>
                <v-text-field
                label="Position"
                outline
                ></v-text-field>
              </v-flex>
            </v-layout>

            <v-layout justify-center row wrap>
              <v-flex xs6 sm3>
                <v-text-field
                label="Email Address"
                outline
                ></v-text-field>
              </v-flex>

              <v-flex xs12 sm3>
                <v-text-field
                label="Contact Number"
                outline
                ></v-text-field>
              </v-flex>
            </v-layout>

          </v-container>
        </v-form>

        <v-layout justify-end row>
            <v-btn color="red darken-1" 
            flat dark
            @click="proceed"
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
import { validationMixin } from 'vuelidate'
import { required, minLength, between } from 'vuelidate/lib/validators'

export default {
  name: 'CustomerForm',
  mixins: [validationMixin],
  validations: {
    company_name: { required },
    office_address: { required },
    contact_person: { required },
    email: { required },
    position: { required },
    selling_dealer: { required },
    unit_models: { required }
  },
  data() {
    return {
      dealers: [],
      selling_dealer: [],
      unit_models: [],
      
      company_name: '',
      office_address: '',
      contact_person: '',
      email: '',
      contact_number: '',
      position: '',
      selling_dealer: [],
      unit_model_id: 0,
    }
  },
  mounted() {
    this.fetchDealers()
  },
  methods: {
    validation (field, name) {
      const errors = []
      if (!this.$v[field].$dirty) return errors
      !this.$v[field].required && errors.push(`${name ? name : field} is required.`)
      return errors
    },
    fetchDealers () {
      axios.get(`http://localhost/fleet_training_request/api/guest/dealers/get`)
      .then(({data}) => {
        data.forEach(element => {
          element.dealer = element.dealer + ' | ' + element.branch
        });
        this.dealers = data
      })
      .catch((error) => {
        console.log(error.response)
      })
    },
    updateSelection () {
      
    },
    proceed () {

    }
  }
}
</script>