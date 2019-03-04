<template>
  <v-layout>
    <v-flex xs12 sm6 offset-sm3>
      <v-dialog
      :value="gallery_data.isOpen"
      width="700"
      persistent
      lazy
      >
        <v-card>
          <v-container 
          grid-list-md
          fluid
          >
            <v-layout row wrap>
              <v-flex
              v-for="(item, index) in images"
              :key="index"
              xs4
              >
                <v-card flat tile>
                  <v-img
                    :src="`${base_url}/public/images/photo_gallery/${item.image}`"
                    aspect-ratio="2.75"
                    width="100%" height="200"
                    v-bind:alt="item.image"
                  ></v-img>
                </v-card>
              </v-flex>
            </v-layout>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn 
              @click="closeGallery"
              color="red" 
              small 
              dark 
              >
                <i class="fa fa-times"></i>&nbsp;
                CLOSE 
              </v-btn>
            </v-card-actions>
          </v-container>
        </v-card>
      </v-dialog>
    </v-flex>
  </v-layout>
</template>

<script>
import { mapGetters, mapState } from 'vuex'

export default {
  props: {
    gallery_data: Object
  },
  computed: {
    ...mapGetters('request', ['getImages']),
    images() {
      if (this.gallery_data.isOpen) 
        return this.getImages(this.gallery_data.image_index)
    }
  },
  methods: {
    closeGallery () {
      this.$emit('closeGallery')
    }
  }
}
</script>

