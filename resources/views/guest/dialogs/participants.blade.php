<v-dialog v-model="dialog" max-width="290">
    <v-card>
        <v-card-text>
            <div class="form-group">
                <label for="">Participants</label>
                <input type="text" class="form-control" v-model="participants.participant">
            </div>
            <div class="form-group">
                <label for="">Quantity</label>
                <input type="number" class="form-control" v-model="participants.quantity">
            </div>
        </v-card-text>
        <v-card-actions style="margin-top: -18px;">
            <v-spacer></v-spacer>
            <v-btn color="green darken-1" flat v-on:click="add">Save</v-btn>
        </v-card-actions>
    </v-card>
</v-dialog>