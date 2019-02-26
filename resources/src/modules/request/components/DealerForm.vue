<template>
  <v-layout>
    <v-flex>
      <v-card>
        <v-form>
          <v-container fluid>
            <v-layout justify-center row wrap>
              <v-flex xs6 sm6>
                <v-text-field
                label="Isuzu Dealership Name"
                v-model="dealership_name"
                @input="$v.dealership_name.$touch()"
                @blur="$v.dealership_name.$touch()"
                :error-messages="validation('dealership_name', 'Dealership Name')"
                outline
                required
                ></v-text-field>
              </v-flex>
            </v-layout>

            <v-layout justify-center row wrap>
              <v-flex xs6 sm3>
                <v-text-field
                label="Name of requester"
                v-model="requestor_name"
                @input="$v.requestor_name.$touch()"
                @blur="$v.requestor_name.$touch()"
                :error-messages="validation('requestor_name', 'Requestor Name')"
                outline
                required
                ></v-text-field>
              </v-flex>

              <v-flex xs12 sm3>
                <v-text-field
                label="Position"
                v-model="position"
                @input="$v.position.$touch()"
                @blur="$v.position.$touch()"
                :error-messages="validation('position')"
                outline
                required
                ></v-text-field>
              </v-flex>
            </v-layout>

            <v-layout justify-center row wrap>
              <v-flex xs6 sm3>
                <v-text-field
                label="Email Address"
                v-model="email"
                @input="$v.email.$touch()"
                @blur="$v.email.$touch()"
                :error-messages="validation('email')"
                outline
                required
                ></v-text-field>
              </v-flex>

              <v-flex xs12 sm3>
                <v-text-field
                label="Contact Number"
                v-model="contact"
                @input="$v.contact.$touch()"
                @blur="$v.contact.$touch()"
                :error-messages="validation('contact')"
                outline
                required
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
import { required, minLength, between, email, integer } from 'vuelidate/lib/validators'
import { mapGetters, mapState } from 'vuex'

export default {
  name: 'DealerForm',
  mixins: [validationMixin],
  validations: {
    dealership_name: { required },
    requestor_name: { required },
    position: { required },
    email: { required, email },
    contact: { required, integer },
  },
  data() {
    return {
      dealership_name: '',
      requestor_name: '',
      position: '',
      email: '',
      contact: ''
    }
  },
  methods: {
    validation (field, name) {
      const errors = []
      if (!this.$v[field].$dirty) return errors
      !this.$v[field].required && errors.push(`${name ? name : field} is required.`)

      if (field === 'email') {
        !this.$v.email.email && errors.push('Invalid Email')
      }

      if (field === 'contact') {
        !this.$v.contact.integer && errors.push('Invalid Contact Number')
      }

      return errors
    },
    proceed () {
      this.$v.$touch()

      if (this.$v.$anyError) {
        return alert('you must complete the form')
      }

      const data = {
        dealership_name: this.dealership_name,
        requestor_name: this.requestor_name,
        position: this.position,
        email: this.email,
        contact: this.contact
      }

      this.$store.dispatch('request/addDealerData', data)
    }
  }
}
</script>