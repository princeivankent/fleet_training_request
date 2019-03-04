<template>
  <v-dialog
  :value="gallery_data.isOpen"
  width="850"
  lazy
  >
    <v-card>
      <v-card-text>
        <v-layout>
          <v-flex md12>
            <v-card>
              <v-container grid-list-sm fluid>
                <v-layout row wrap>
                  <div class="row" id="images">
                    <div class="col-md-4 image-thumb-container" 
                    v-for="(item, index) in images"
                    :key="index"
                    >
                      <img :src="`${base_url}/public/images/photo_gallery/${item.image}`" 
                      width="250" height="200"
                      v-bind:alt="item.image"
                      >
                    </div>
                  </div>
                </v-layout>
              </v-container>
            </v-card>
          </v-flex>
        </v-layout>
      </v-card-text>
    </v-card>
  </v-dialog>
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
  }
}
</script>

