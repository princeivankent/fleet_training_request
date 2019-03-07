<template>
  <v-snackbar
  v-model="status"
  :timeout="6000"
  right
  bottom
  >
    {{ text }}
    <v-btn
    color="red"
    flat
    @click="$emit('close', false)"
    >
      Close
    </v-btn>
  </v-snackbar>
</template>

<script>
export default {
  name: 'Snackbar',
  props: {
    status: Boolean,
    text: String
  }
}
</script>
