<template>
  <v-snackbar
  v-model="toastNotif.status"
  :timeout="6000"
  right
  bottom
  >
    {{ toastNotif.message }}
    <v-btn
    color="red"
    flat
    @click="close"
    >
      Close
    </v-btn>
  </v-snackbar>
</template>

<script>
import { mapState, mapMutations } from 'vuex'

export default {
  name: 'Snackbar',
  computed: mapState('request', ['toastNotif']),
  methods: {
    ...mapMutations('request', ['CLOSE_NOTIFICATION']),
    close () {
      this.CLOSE_NOTIFICATION()
    }
  }
}
</script>
