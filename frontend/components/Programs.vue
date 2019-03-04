<template>
  <ProgramCards />
</template>

<script>
import { mapState } from 'vuex'
import ProgramCards from './ProgramCards'

export default {
  name: 'Programs',
  components: {ProgramCards},
  computed: {
    ...mapState('request', ['forms'])
  }
}
</script>
