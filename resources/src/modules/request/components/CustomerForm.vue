<template>
  <v-layout>
    <v-flex>
      <v-card>
        <v-form>
          <v-container fluid>
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
import { mapGetters } from 'vuex'

export default {
  name: 'CustomerForm',
  mixins: [validationMixin],
  validations: {
    selling_dealer: {
      required,
      minLength: minLength(4)
    },
    age: {
      between: between(20, 30)
    }
  },
  data() {
    return {
      dealers: [],
      selling_dealer: []
    }
  },
  computed: {
    ...mapGetters('request', [
      'requestFormState'
    ]),

    nameErrors () {
      const errors = []
      if (!this.$v.selling_dealer.$dirty) return errors
      !this.$v.selling_dealer.required && errors.push('Name is required.')
      return errors
    },
  },
  mounted() {
    this.fetchDealers()
  },
  methods: {
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
      this.$store.dispatch('request/addFormData', {selling_dealer: this.selling_dealer})
    },
    proceed () {

    }
  }
}
</script>