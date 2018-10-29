<div class="row">
    <div class="col-md-6" v-for="(item, index) in training_programs" v-bind:key="index">
        <div class="card shadow p-3 mb-5 bg-white rounded">
            <div class="card-body">
                <h5 class="card-title">
                    @{{ item.program_title }}
                    <small class="grey--text float-left mt-1">
                        @{{ item.description }}
                    </small>
                </h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item" v-for="(item, index) in item.program_features">
                    <i class="fa fa-caret-right"></i> &nbsp;
                    @{{ item.feature }}
                </li>
            </ul>
            <div class="card-body">
                <div class="float-right">
                    <button v-on:click="openGallery(item.training_program_id)" class="btn btn-outline-secondary" style="margin: -12px 0px;">
                        GALLERY &nbsp;
                        <i class="fa fa-image"></i>
                    </button>
                    <button 
                    v-if="item.training_program_id === form.training_program_id" 
                    v-on:click="trainingProgramPicked(item.training_program_id)" 
                    class="btn btn-success" style="margin: -12px 0px;">
                        SELECTED &nbsp; 
                        <i class="fa fa-check-circle"></i>
                    </button>
                    <button v-else v-on:click="trainingProgramPicked(item.training_program_id)" class="btn btn-outline-danger" style="margin: -12px 0px;">
                        PROCEED &nbsp; 
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<v-dialog
v-model="photo_gallery"
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
                                    <div class="col-md-4 image-thumb-container" v-for="(item, index) in images">
                                        <img v-bind:src="`{{ url('public/images/photo_gallery') }}/${item.image}`" 
                                        width="250" height="200"
                                        v-bind:alt="item.image">
                                    </div>
                                </div>
                            </v-flex>
                        </v-layout>
                    </v-container>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-card-text>
    </v-card>
</v-dialog>