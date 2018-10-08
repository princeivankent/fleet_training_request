<div class="row">
    <div class="col-md-6">
        <div class="card shadow p-3 mb-5 bg-white rounded">
            <div class="card-body">
                <h5 class="card-title">
                    <span class="badge badge-pill badge-success">
                        <i class="fa fa-star fa-sm" style="padding: 6px 0px;"></i>
                    </span>
                    PRE-DELIVERY TRAINING
                    <small class="grey--text float-left ml-2 mt-1">Recommended for driver, driver assistant and other non-technical.</small>
                </h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <i class="fa fa-caret-right"></i>
                    Product Feature Orientation and Familiarization
                </li>
                <li class="list-group-item">
                    <i class="fa fa-caret-right"></i> 
                    Vehicle Handling and Operation
                </li>
                <li class="list-group-item">
                    <i class="fa fa-caret-right"></i>
                    Pre-drive and Post-drive Safety Practices
                </li>
            </ul>
            <div class="card-body">
                <div class="float-right">
                    <button v-on:click="photo_gallery = 1" class="btn btn-outline-secondary" style="margin: -12px 0px;">
                        GALLERY
                        <i class="fa fa-images"></i>
                    </button>
                    <button v-on:click="step(4)" class="btn btn-outline-success" style="margin: -12px 0px;">
                        PROCEED
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow p-3 mb-5 bg-white rounded">
            <div class="card-body">
                <h5 class="card-title">
                    <span class="badge badge-pill badge-success">
                        <i class="fa fa-star fa-sm" style="padding: 6px 0px;"></i>
                    </span>
                    PRE-DELIVERY TRAINING
                    <small class="grey--text float-left ml-2 mt-1">Recommended for driver, driver assistant and other non-technical.</small>
                </h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <i class="fa fa-caret-right"></i>
                    Product Feature Orientation and Familiarization
                </li>
                <li class="list-group-item">
                    <i class="fa fa-caret-right"></i> 
                    Vehicle Handling and Operation
                </li>
                <li class="list-group-item">
                    <i class="fa fa-caret-right"></i>
                    Pre-drive and Post-drive Safety Practices
                </li>
            </ul>
            <div class="card-body">
                <div class="float-right">
                    <button v-on:click="photo_gallery = 1" class="btn btn-outline-secondary" style="margin: -12px 0px;">
                        GALLERY
                        <i class="fa fa-images"></i>
                    </button>
                    <button v-on:click="step(4)" class="btn btn-outline-success" style="margin: -12px 0px;">
                        PROCEED
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<v-dialog
v-model="photo_gallery"
width="800"
lazy
>
    <v-card>
        <v-card-text>
            <v-layout>
                <v-flex md12>
                    <v-card>
                    <v-container grid-list-sm fluid>
                        <v-layout row wrap>
                            {{-- <v-flex
                                v-for="n in 9"
                                :key="n"
                                xs4
                                d-flex
                            > --}}
                                {{-- <v-card flat tile class="d-flex">
                                    <v-img
                                        :src="`https://picsum.photos/500/300?image=${n * 5 + 10}`"
                                        :lazy-src="`https://picsum.photos/10/6?image=${n * 5 + 10}`"
                                        aspect-ratio="1"
                                        class="grey lighten-2">

                                        <v-layout
                                        slot="placeholder"
                                        fill-height
                                        align-center
                                        justify-center
                                        ma-0>
                                        
                                            <v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
                                        </v-layout>
                                    </v-img>
                                </v-card> --}}
                                <div>
                                    <ul id="images">
                                        <li><img class="d-block w-100" src="{{ url('public/images/sample3.jpg') }}" height="200" alt="First slide"></li>
                                        <li><img class="d-block w-100" src="{{ url('public/images/sample2.jpg') }}" height="200" alt="First slide"></li>
                                        <li><img class="d-block w-100" src="{{ url('public/images/sample1.jpg') }}" height="200" alt="First slide"></li>
                                    </ul>
                                </div>
                            {{-- </v-flex> --}}
                        </v-layout>
                    </v-container>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-card-text>

        {{-- <v-divider></v-divider> --}}

        {{-- <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
            color="primary"
            flat
            >
            I accept
            </v-btn>
        </v-card-actions> --}}
    </v-card>
</v-dialog>