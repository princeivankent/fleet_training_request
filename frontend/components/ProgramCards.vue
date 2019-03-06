<template>
  <v-layout>
    <v-flex>
      <v-card>
        <v-container 
        fluid
        >
          <v-layout align-center justify-center row fill-height wrap>
            <v-flex
            v-for="(item, index) in training_programs"
            :key="item.training_program_id"
            :class="{'ma-0': $vuetify.breakpoint.smAndDown, 'ma-2': $vuetify.breakpoint.mdAndUp}"
            xs12 sm6 md4
            >
              <v-card class="elevation-5">
                <v-card-title primary-title>
                  <div class="card-title">
                    <h3 class="headline mb-0">{{ item.program_title }}</h3>
                    <div>{{ item.description }}</div>
                  </div>
                </v-card-title>

                <v-data-table
                :items="item.program_features"
                hide-headers
                hide-actions
                >
                  <template v-slot:items="props">
                    <td>
                      <ion-icon name="checkmark-circle-outline"></ion-icon>&nbsp;
                      {{ props.item.feature }}
                    </td>
                  </template>
                </v-data-table>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn @click="openGallery(index)" color="default" small>
                    <i class="fa fa-images"></i>&nbsp;
                    SEE PHOTOS
                  </v-btn>
                  <v-btn @click="updateForm('training_program_id', item.training_program_id)" color="success" small>
                    SELECT &nbsp;
                    <i class="fa fa-arrow-circle-right"></i>
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-flex>
          </v-layout>
        </v-container>
        <v-card-actions>
          <v-btn 
          @click="back"
          color="red darken-1" 
          flat dark
          >
            <v-icon small>fa fa-arrow-circle-left</v-icon>&nbsp;
            Back
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-flex>
    <ProgramCardGallery :gallery_data="gallery_data" v-on:closeGallery="closeGallery"/>
  </v-layout>
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
      return this.$store.dispatch('request/setTrainingPrograms')
    },
    openGallery (payload) {
      this.gallery_data = {
        image_index: payload,
        isOpen: true
      }
    },
    closeGallery () {
      this.gallery_data = {
        image_index: 0,
        isOpen: false
      }
    },
    async updateForm (field, value) {
      const data = this.$store.commit('request/UPDATE_FORM', {key:field,value:value})
      this.$store.commit('request/NEXT_PAGE')
    },
    back () {
      this.$store.commit('request/BACK_PAGE')
    }
  }
}
</script>

<style scoped>
.card-title {
  min-height: 80px;
}
ion-icon {
  font-size: 14px;
  color: green;
}
</style>
