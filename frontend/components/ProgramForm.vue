<template>
  <div>
    <v-container fluid>
      <v-layout row wrap>
        <v-flex 
        v-for="(item) in training_programs"
        :key="item.training_program_id"
        :class="{'ma-0': $vuetify.breakpoint.smAndDown, 'ma-2': $vuetify.breakpoint.mdAndUp}"
        xs12 sm6 md4
        >
          <v-card>
            <v-img
              src="https://cdn.vuetifyjs.com/images/cards/desert.jpg"
              aspect-ratio="2.75"
            ></v-img>

            <v-card-title primary-title>
              <div>
                <h3 class="headline mb-0">Kangaroo Valley Safari</h3>
                <div> Test </div>
              </div>
            </v-card-title>

            <v-card-actions>
              <v-btn flat color="orange">Share</v-btn>
              <v-btn flat color="orange">Explore</v-btn>
            </v-card-actions>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
  name: 'ProgramForm',
  data () {
    return {
      training_programs: []
    }
  },
  computed: {
    ...mapState('request', ['forms'])
  },
  mounted () {
    this.fetchTrainingPrograms()
  },
  methods: {
    fetchTrainingPrograms () {
      axios.get(`${this.base_url}/guest/training_programs/get`)
      .then(({data}) => {
        this.training_programs = data;
      })
      .catch((error) => {
        console.log(error);
      });
    }
  }
}
</script>
