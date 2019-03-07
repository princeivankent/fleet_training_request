<template>
  <v-layout>
    <v-flex>
      <v-card>
        <v-form>
          <v-container fluid>
            <v-layout justify-center row wrap>
              <v-flex xs6 sm6>
                <h5 class="display-1">Requesting Isuzu Dealer</h5>
              </v-flex>
            </v-layout>

            <v-layout justify-center row wrap>
              <v-flex xs6 sm6>
                <v-text-field
                label="Isuzu Dealership Name"
                :value="form.dealer_info.dealership_name"
                @input="updateForm('dealership_name', $event)"
                @blur="$v.dealership_name.$touch()"
                outline
                required
                ></v-text-field>
              </v-flex>
            </v-layout>

            <v-layout justify-center row wrap>
              <v-flex xs6 sm3>
                <v-text-field
                label="Name of requester"
                :value="form.dealer_info.requestor_name"
                @input="updateForm('requestor_name', $event)"
                @blur="$v.requestor_name.$touch()"
                outline
                required
                ></v-text-field>
              </v-flex>

              <v-flex xs12 sm3>
                <v-text-field
                label="Position"
                :value="form.dealer_info.position"
                @input="updateForm('position', $event)"
                @blur="$v.position.$touch()"
                outline
                required
                ></v-text-field>
              </v-flex>
            </v-layout>

            <v-layout justify-center row wrap>
              <v-flex xs6 sm3>
                <v-text-field
                label="Email Address"
                :value="form.dealer_info.email"
                @input="updateForm('email', $event)"
                @blur="$v.email.$touch()"
                outline
                required
                ></v-text-field>
              </v-flex>

              <v-flex xs12 sm3>
                <v-text-field
                label="Contact Number"
                :value="form.dealer_info.contact"
                @input="updateForm('contact', $event)"
                @blur="$v.contact.$touch()"
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
import { mapGetters, mapState, mapMutations } from 'vuex'

export default {
  name: 'DealerForm',
  mixins: [validationMixin],
  validations: {
    dealership_name: { required },
    requestor_name: { required },
    position: { required },
    email: { required, email },
    contact: { required, integer, minLength: minLength(11) },
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
  computed: {
    ...mapState('request', ['form'])
  },
  methods: {
    updateForm (field, value) {
      this.$store.commit('request/UPDATE_DEALER_FORM', {key:field,value:value})
    },
    async proceed () {
      // this.$v.$touch()

      // if (this.$v.$anyError) {
      //   return alert('Please check the form')
      // }

      // const data = {
      //   dealership_name: this.dealership_name,
      //   requestor_name: this.requestor_name,
      //   position: this.position,
      //   email: this.email,
      //   contact: this.contact
      // }

      const data = await this.$store.dispatch('request/addDealerData', data)
      this.$store.commit('request/NEXT_PAGE')
    }
  }
}
</script>