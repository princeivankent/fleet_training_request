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
                  v-model="training_date"
                  name="Training Date"
                  v-validate="'required'"
                  :error-messages="errors.first('Training Date')"
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
                name="Training Venue"
                v-model="training_venue"
                v-validate="'required'"
                :error-messages="errors.first('Training Venue')"
                :items="training_venues"
                outline
                ></v-select>
              </v-flex>
            </v-layout>

            <v-layout justify-center row wrap>
              <v-flex xs8 sm8 md8 lg5>
                <v-text-field
                label="Training Address"
                name="Training Address"
                v-model="training_address"
                v-validate="'required'"
                :error-messages="errors.first('Training Address')"
                outline
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
            <v-btn 
            @click="proceed"
            :disabled="isFormInvalid"
            color="red darken-1" 
            flat
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
import moment from 'moment'
import axios from 'axios'
import TrainingFormParticipants from './TrainingFormParticipants'

export default {
  name: 'TrainingForm',
  components: {TrainingFormParticipants},
  data() {
    return {
      // date: new Date().toISOString().substr(0, 10),
      modal: false,
      reactive: true,
      training_venues: ['IPC Customer', 'IPC'],
      disabledDates: [],
      shouldDisable: false,
    }
  },
  computed: {
    ...mapState('request', ['form']),
    dateFormatted () {
      return this.form.training_date ? moment(this.form.training_date).format('dddd, MMMM Do YYYY') : ''
    },
    isFormInvalid () {
      return Object.keys(this.fields).some(key => this.fields[key].invalid);
    },
    training_date: {
      get () {
        return this.$store.state.request.form.training_date
      },
      set (val) {
        this.$store.commit('request/UPDATE_FORM', {key:'training_date',value:val})
      }
    },
    training_venue: {
      get () {
        return this.$store.state.request.form.training_venue
      },
      set (val) {
        this.$store.commit('request/UPDATE_FORM', {key:'training_venue',value:val})
      }
    },
    training_address: {
      get () {
        return this.$store.state.request.form.training_address
      },
      set (val) {
        this.$store.commit('request/UPDATE_FORM', {key:'training_address',value:val})
      }
    },
    company_name: {
      get () {
        return this.$store.state.request.form.company_name
      },
      set (val) {
        this.$store.commit('request/UPDATE_FORM', {key:'company_name',value:val})
      }
    },
    training_participants: {
      get () {
        return this.$store.state.request.form.training_participants
      },
      set (val) {
        this.$store.commit('request/UPDATE_FORM', {key:'training_participants',value:val})
      }
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
      axios.get(`${process.env.MIX_API_URL}guest/schedules/get`)
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
      if (this.training_participants.length <= 0) {
        alert('Fill out training participants')
      }
      else {
        this.$store.commit('request/NEXT_PAGE')
      }
    }
  }
}
</script>
