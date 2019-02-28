<template>
  <div>
    <v-card>
      <v-list>
        <template v-for="(item, index) in items">
          <v-divider
          v-if="index != 0"
          :key="index"
          ></v-divider>
          <div :key="item.title">
            <div v-if="index+1 == items.length">
              <v-list-tile>
                <v-list-tile-action>
                  <v-btn color="success" fab small flat dark>
                    <v-icon>check</v-icon>
                  </v-btn>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-layout row wrap>
                      <v-flex xs12 md7>
                        <v-select 
                        label="Participants"
                        :items="default_participants"
                        ></v-select>
                      </v-flex>
                      <v-divider class="mx-2" inset vertical></v-divider>
                      <v-flex xs12 md4>
                        <v-text-field
                        label="headcount"
                        required
                        ></v-text-field>
                      </v-flex>
                    </v-layout>
                </v-list-tile-content>
              </v-list-tile>
            </div>
            <div v-else>
              <v-list-tile>
                <v-list-tile-action>
                  <v-btn color="red" fab small flat dark>
                    <v-icon>close</v-icon>
                  </v-btn>
                </v-list-tile-action>
                <v-list-tile-content>
                  <v-list-tile-sub-title>
                    <label>Added Item</label>
                  </v-list-tile-sub-title>
                </v-list-tile-content>
              </v-list-tile>
            </div>
          </div>
        </template>
      </v-list>
    </v-card>
  </div>
</template>

<script>
import { mapGetters, mapState } from 'vuex'

export default {
  data() {
    return {
      default_participants: ['Driver', 'Mechanic', 'Fleet Head', 'Others'],
      items: [
        {
          avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg',
          title: 'Brunch this weekend?',
          subtitle: "<span class='text--primary'>Ali Connors</span> &mdash; I'll be in your neighborhood doing errands this weekend. Do you want to hang out?"
        },
        {
          avatar: 'https://cdn.vuetifyjs.com/images/lists/2.jpg',
          title: 'Summer BBQ <span class="grey--text text--lighten-1">4</span>',
          subtitle: "<span class='text--primary'>to Alex, Scott, Jennifer</span> &mdash; Wish I could come, but I'm out of town this weekend."
        },
        {
          avatar: 'https://cdn.vuetifyjs.com/images/lists/3.jpg',
          title: 'Oui oui',
          subtitle: "<span class='text--primary'>Sandra Adams</span> &mdash; Do you have Paris recommendations? Have you ever been?"
        }
      ]
    }
  },
  computed: {
    ...mapState('request', ['form']),
  },
  methods: {
    
  }
}
</script>

