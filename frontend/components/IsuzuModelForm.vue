<template>
  <v-layout>
    <v-flex>
      <v-card>
        <v-card-title primary-title>
          <div>
            <h3 class="headline mb-0">Isuzu Models</h3>
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
