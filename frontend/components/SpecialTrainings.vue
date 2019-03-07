<template>
  <div>
    <v-layout row wrap>
      <v-flex
      v-for="(item,index) in special_trainings"
      :key="index"
      xs4
      >
        <v-card>
          <v-carousel 
          class="carousel-size"
          delimiter-icon="stop" 
          >
            <v-carousel-item
            v-for="(image,i) in item.special_training_images"
            :key="i"
            :src="photoURL + image.image"
            >
            <v-container fill-height fluid>
              <v-layout fill-height>
                <v-flex xs12 align-end flexbox>
                  <span class="headline white--text darken-2 title-border">{{ item.program_title }}</span>
                </v-flex>
              </v-layout>
            </v-container>
            </v-carousel-item>
          </v-carousel>
        </v-card>
      </v-flex>
    </v-layout>
  </div>
</template>

<script>
export default {
  name: 'SpecialTrainings',
  computed: {
    special_trainings () {
      return this.$store.state.request.special_trainings
    },
    photoURL () {
      return `${this.base_url}public/images/photo_gallery/`
    }
  },
  mounted () {
    this.fetchSpecialTrainings()
  },
  methods: {
    fetchSpecialTrainings () {
      this.$store.dispatch('request/setSpecialTrainings')
    }
  }
}
</script>

<style scoped>
.carousel-size {
  max-height: 600px; 
  min-height: auto;
}
.title-border {
  text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
}
</style>
