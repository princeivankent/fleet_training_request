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
    },
  }
}
</script>

<template>
  <v-layout>
    <v-flex>
      <v-card>
        <v-card-title primary-title>
          <div>
            <h3 class="headline mb-0">Program Offering</h3>
          </div>
        </v-card-title>

        <v-layout justify-end row>
          <v-btn color="red darken-1" flat dark>
            Proceed &nbsp;
            <v-icon small>fa fa-arrow-circle-right</v-icon>
          </v-btn>
        </v-layout>
      </v-card>
    </v-flex>
  </v-layout>
</template>
