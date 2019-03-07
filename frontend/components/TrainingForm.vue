<template>
  <v-layout>
    <v-flex>
      <v-card>
        <v-form>
          <v-container fluid>
            <v-layout justify-center row wrap>
              <v-flex xs8 sm8 md8 lg5>
                <h5 class="display-1">Training Details</h5>
              </v-flex>
            </v-layout>

            <v-layout justify-center row wrap>
              <v-flex xs8 sm8 md8 lg5>
                <v-dialog
                ref="dialog"
                v-model="modal"
                :return-value.sync="form.training_date"
                persistent
                lazy
                full-width
                width="300px"
                >
                  <v-text-field
                  slot="activator"
                  :value="dateFormatted"
                  label="Request Training Date"
                  append-icon="event"
                  outline
                  clearable
                  readonly
                  ></v-text-field>

                  <v-date-picker
                  :value="form.training_date"
                  @change="updateForm('training_date', $event)"
                  :allowed-dates="allowedDates"
                  :reactive="reactive"
                  width="100%"
                  color="green"
                  scrollable
                  >
                    <v-spacer></v-spacer>
                    <v-btn flat color="green" @click="modal = false">Cancel</v-btn>
                    <v-btn flat color="green" @click="$refs.dialog.save(form.training_date)">OK</v-btn>
                  </v-date-picker>
                </v-dialog>
              </v-flex>
            </v-layout>

            <v-layout justify-center row wrap>
              <v-flex xs8 sm8 md8 lg5>
                <v-select
                label="Training Venue"
                :value="form.training_venue"
                @change="updateForm('training_venue', $event)"
                :items="training_venues"
                outline
                required
                ></v-select>
              </v-flex>
            </v-layout>

            <v-layout justify-center row wrap>
              <v-flex xs8 sm8 md8 lg5>
                <v-text-field
                label="Training Address"
                :value="form.training_address"
                @input="updateForm('training_address', $event)"
                outline
                required
                ></v-text-field>
              </v-flex>
            </v-layout>

            <v-layout justify-center row wrap>
              <v-flex xs8 sm8 md8 lg5>
                <!-- Training Form Participants -->
                <TrainingFormParticipants />
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
import { mapGetters, mapState } from 'vuex'
import { validationMixin } from 'vuelidate'
import { required, minLength, between } from 'vuelidate/lib/validators'
import moment from 'moment'
import TrainingFormParticipants from './TrainingFormParticipants'

export default {
  name: 'TrainingForm',
  components: {TrainingFormParticipants},
  mixins: [validationMixin],
  validations: {
    training_venue: { required },
  },
  data() {
    return {
      // date: new Date().toISOString().substr(0, 10),
      modal: false,
      reactive: true,
      training_venues: ['IPC Customer', 'IPC'],
      disabledDates: [],
    }
  },
  computed: {
    ...mapState('request', ['form']),
    dateFormatted () {
      return this.form.training_date ? moment(this.form.training_date).format('dddd, MMMM Do YYYY') : ''
    },
  },
  mounted () {
    this.getDisabledDates()
  },
  methods: {
    updateForm (field, value) {
      this.$store.commit('request/UPDATE_FORM', {key:field,value:value})
    },
    allowedDates (date) {
      return this.disabledDates.indexOf(date) === -1 
    },
    getDisabledDates () {
      axios.get(`${this.base_url}api/guest/schedules/get`)
      .then(({data}) => {
        var dates = []
        data.map((date) => {
          date.date_range.forEach(element => {
            dates.push(element)
          })
        })

        this.disabledDates = dates
      })
      .catch((error) => {
        console.log(error.response)
      })
    },
    back () {
      this.$store.commit('request/BACK_PAGE')
    },
    proceed () {
      this.$store.commit('request/NEXT_PAGE')
    }
  }
}
</script>
