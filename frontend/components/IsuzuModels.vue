<template>
  <v-layout>
    <v-flex>
      <v-card flat>
        <v-card-title primary-title>
          <div>
            <h3 class="raleway headline mb-0">Choose Isuzu Model</h3>
            <v-btn 
            @click="back"
            color="red darken-1" 
            dark
            >
              <v-icon small>fa fa-arrow-circle-left</v-icon>&nbsp;
              Back
            </v-btn>
            <v-btn 
            @click="nextPage"
            color="red darken-1" 
            dark
            >
              Proceed &nbsp;
              <v-icon small>fa fa-arrow-circle-right</v-icon>
            </v-btn>
          </div>
        </v-card-title>

        <v-card-text>
          <div 
          v-for="(item, index) in unit_models"
          :key="item.unit_model_id"
          @click="unitModelPicked('unit_model_id', item.unit_model_id)"
          @mouseenter="hover(index)"
          @mouseleave="unhover(index)"
          class="raleway menu">
            <img 
            :id="`item-${index}`"
            :src="`${base_url}/public/images/unit_models/${item.image}`" 
            :alt="item.image">
            <p :class="`${form.unit_model_id == item.unit_model_id ? 'green--text' : ''}`">
              <i v-if="form.unit_model_id == item.unit_model_id" 
              class="fa fa-check-circle"
              ></i>
              {{ item.model_name }}
            </p>
          </div>
        </v-card-text>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
import { mapGetters, mapState } from 'vuex'

export default {
  name: 'IsuzuModels',
  computed: mapState('request', [
    'form',
    'unit_models'
  ]),
  created () {
    this.displayImages ()
  },
  methods: {
    hover (index) {
      document.querySelector('#item-' + index).classList.add('animated', 'pulse', 'faster')
    },
    unhover (index) {
      document.querySelector('#item-' + index).classList.remove('animated', 'pulse', 'faster')
    },
    unitModelPicked (field, value) {
      this.$store.commit('request/UPDATE_FORM', {key:field,value:value})
    },
    displayImages () {
      this.$store.dispatch('request/fetchUnitModels')
    },
    nextPage () {
      this.$store.commit('request/NEXT_PAGE')
    },
    back () {
      this.$store.commit('request/BACK_PAGE')
    }
  }
}
</script>

<style scoped>
.raleway {
  color: #636b6f;
  font-family: 'Raleway', sans-serif;
  font-weight: 600;
}
.menu {
  width:170px; 
  text-align:center; 
  float:left; 
  position:relative
}
.menu_label {
  color:#FFFFFF; 
  float:left; 
  position:absolute; 
  top:20px; 
  left:150px;
} 
.swal-button--confirm {
  background-color: #F44336;
}
.menu:hover {
  cursor: pointer;
}
</style>
