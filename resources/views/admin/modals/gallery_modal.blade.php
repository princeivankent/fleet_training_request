<div class="modal fade" id="gallery_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <i class="fa fa-image"></i>&nbsp;
                    Photo Gallery
                </h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="image">Upload Image</label>
                        <input type="file" id="image" v-on:change="onImageChange">

                        <span v-if="errors.image" class="text-danger">
                            @{{ errors.image[0] }}
                        </span>
                    </div>
                    {{-- <div class="form-group col-md-8" v-if="image">
                        <img :src="image" class="img-responsive" height="160" width="150">
                    </div> --}}
                </div>

                <div class="row" id="images">
                    <div class="col-md-4 image-thumb-container" v-for="(item, index) in images">
                        <img v-bind:src="`{{ url('public/images/photo_gallery') }}/${item.image}`" 
                        width="280" height="200"
                        v-bind:alt="item.image">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-flat btn-primary" v-on:click="uploadImage"><i class="fa fa-check"></i> SAVE CHANGES</button>
            </div>
        </div>
    </div>
</div>