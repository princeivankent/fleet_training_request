<template>
  <v-container fluid>
    <v-layout row>
      <v-flex 
      v-for="(item, index) in training_programs"
      :key="item.training_program_id"
      :class="{'ma-0': $vuetify.breakpoint.smAndDown, 'ma-2': $vuetify.breakpoint.mdAndUp}"
      xs12 sm6 md4
      >
        <v-card>
          <v-card-title primary-title>
            <div class="card-title">
              <h3 class="headline mb-0">{{ item.program_title }}</h3>
              <div>{{ item.description }}</div>
            </div>
          </v-card-title>

          <v-data-table
          :items="item.program_features"
          class="elevation-1"
          hide-headers
          hide-actions
          >
            <template v-slot:items="props">
              <td>
                <i class="fa fa-dot-circle"></i>&nbsp;
                {{ props.item.feature }}
              </td>
            </template>
          </v-data-table>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="default" small>
              <i class="fa fa-images"></i>&nbsp;
              SEE PHOTOS

            </v-btn>
            <v-btn color="success" small @click="openGallery(index)">
              SELECT &nbsp;
              <i class="fa fa-arrow-circle-right"></i>
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
    <ProgramCardGallery :gallery_data="gallery_data"/>
  </v-container>
</template>

<script>
import { mapGetters, mapState } from 'vuex'
import ApiService from '../services/api.service'
import ProgramCardGallery from './ProgramCardGallery'

export default {
  name: 'ProgramCards',
  components: {ProgramCardGallery},
  data () {
    return {
      gallery_data: {
        image_index: 0,
        isOpen: false
      }
    }
  },
  computed: {
    ...mapState('request', ['training_programs']),
    ...mapGetters('request', ['getImages'])
  },
  mounted () {
    this.fetchTrainingPrograms()
  },
  methods: {
    fetchTrainingPrograms () {
      this.$store.dispatch('request/setTrainingPrograms')
    },
    openGallery(payload) {
      this.gallery_data = {
        image_index: payload,
        isOpen: true
      }
    },
  }
}
</script>

<style scoped>
.card-title {
  min-height: 80px;
}
</style>
