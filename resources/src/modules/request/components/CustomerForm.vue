<template>
  <v-layout>
    <v-flex>
      <v-card>
        <v-form>
          <v-container fluid>
            <v-layout justify-center row wrap>
              <v-flex xs6 sm8>
                <v-text-field
                label="Company Name"
                :value="form.company_name"
                @input="updateForm('company_name', $event)"
                @blur="$v.company_name.$touch()"
                outline
                required
                ></v-text-field>
              </v-flex>
            </v-layout>

            <v-layout justify-center row wrap>
              <v-flex xs6 sm8>
                <v-text-field
                label="Office Address"
                :value="form.office_address"
                @input="updateForm('office_address', $event)"
                @blur="$v.office_address.$touch()"
                outline
                required
                ></v-text-field>
              </v-flex>
            </v-layout>

            <v-layout justify-center row wrap>
              <v-flex xs6 sm4>
                <v-text-field
                label="Contact Person"
                :value="form.contact_person"
                @input="updateForm('contact_person', $event)"
                @blur="$v.contact_person.$touch()"
                outline
                required
                ></v-text-field>
              </v-flex>
              <v-flex xs6 sm4>
                <v-text-field
                label="Position"
                :value="form.position"
                @input="updateForm('position', $event)"
                @blur="$v.position.$touch()"
                outline
                required
                ></v-text-field>
              </v-flex>
            </v-layout>

            <v-layout justify-center row wrap>
              <v-flex xs6 sm4>
                <v-text-field
                label="Email Address"
                :value="form.email"
                @input="updateForm('email', $event)"
                @blur="$v.email.$touch()"
                outline
                required
                ></v-text-field>
              </v-flex>
              <v-flex xs6 sm4>
                <v-text-field
                label="Contact Number"
                :value="form.contact_number"
                @input="updateForm('contact_number', $event)"
                @blur="$v.contact_number.$touch()"
                outline
                required
                ></v-text-field>
              </v-flex>
            </v-layout>

            <v-layout justify-center row wrap>
              <v-flex xs6 sm4>
                <v-select
                label="Isuzu Dealership Name"
                :value="form.selling_dealer"
                @change="updateForm('selling_dealer', $event)"
                :items="dealers"
                item-text="dealer"
                item-value="dealer_id"
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

              <v-flex xs6 sm4>
                <v-select
                label="Isuzu Specific Model"
                :value="form.unit_models"
                @change="updateForm('unit_models', $event)"
                :items="models"
								item-text="model_name"
                item-value="model_name"
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
import { mapGetters, mapState } from 'vuex'

export default {
  name: 'CustomerForm',
  mixins: [validationMixin],
  validations: {
    company_name: { required },
    office_address: { required },
    contact_person: { required },
    contact_number: { required },
    email: { required },
    position: { required },
    selling_dealer: { required },
    unit_models: { required }
  },
  data() {
    return {
      dealers: [],
      models: []
    }
  },
  computed: {
    ...mapState('request', ['form'])
  },
  mounted() {
    this.fetchDealers()
    this.fetchUnitModels()
  },
  methods: {
    updateForm (field, value) {
      this.$store.commit('request/UPDATE_FORM', {key:field,value:value})
    },
    fetchDealers () {
      axios.get(`${this.baseURL}api/guest/dealers/get`)
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
    fetchUnitModels () {
      axios.get(`${this.baseURL}api/guest/unit_models/get`)
      .then(({data}) => {
        this.models = data;
      })
      .catch((error) => {
        console.log(error);
      });
    },
    updateSelection () {
      
    },
    proceed () {

    }
  }
}
</script>