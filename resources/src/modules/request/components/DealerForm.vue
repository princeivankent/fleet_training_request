<template>
  <v-layout>
    <v-flex>
      <v-card>
        <v-card-title primary-title>
          <div>
            <h3 class="headline mb-0">Requesting Isuzu Dealer</h3>
          </div>
        </v-card-title>

        <v-form>
          <v-container>
            <v-layout align-center>

              <v-flex xs12 md4>
                <label>Isuzu Dealership Name</label>
                <v-text-field
                  solo
                ></v-text-field>
              </v-flex>

              <v-flex md4>
                <label>Name of requester</label>
                <v-text-field
                  solo
                ></v-text-field>
              </v-flex>

              <v-flex md4>
                <label for="selling_dealer">Selling Dealer</label>
                  <!-- v-model="form.selling_dealer" -->
                <v-select
                  :items="dealers"
                  item-text="dealer"
                        item-value="dealer_id"
                  chips
                  label="Selling Dealers"
                  deletable-chips
                  multiple
                  solo
                  single-line
                >
                  <template
                  slot="selection"
                  slot-scope="{ item, index }"
                  >
                  <v-chip v-if="index === 0">
                    <span>@{{ item.dealer }}</span>
                  </v-chip>
                  <span
                    v-if="index === 1"
                    class="grey--text caption"
                  >(+@{{ form.selling_dealer.length - 1 }} others)</span>
                  </template>
                </v-select>
              </v-flex>

            </v-layout>
          </v-container>
        </v-form>

        <v-layout justify-end row>
            <v-btn color="red darken-1" flat dark>
              Proceed &nbsp;
              <v-icon small>fa fa-arrow-circle-right</v-icon>
            </v-btn>
        </v-layout>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  name: 'DealerForm',
  data() {
    return {
      dealers: []
    }
  },
  mounted() {
    this.fetchDealers()
  },
  methods: {
    fetchDealers () {
      axios.get(`http://localhost/fleet_training_request/api/guest/dealers/get`)
      .then(({data}) => {
        data.forEach(element => {
          element.dealer = element.dealer + ' | ' + element.branch
        });
        this.dealers = data
      })
      .catch((error) => {
        console.log(error.response)
      })
    }
  }
}
</script>