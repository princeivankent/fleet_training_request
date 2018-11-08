<div class="modal fade" id="special_training_images">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <i class="fa fa-image"></i>&nbsp;
                    Special Training Images
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
                </div>

                <div class="row" id="images">
                    <div class="col-md-4 image-thumb-container" v-for="(item, index) in special_training_images">
                        <img v-bind:src="`{{ url('public/images/photo_gallery') }}/${item.image}`" 
                        width="280" height="200"
                        v-bind:alt="item.image">
                        <a class="btn btn-sm btn-danger" v-on:click="deleteImage(item.special_training_image_id, index)" style="margin-top: -52px;"><i class="fa fa-times"></i></a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-flat btn-primary" v-on:click="uploadImage"><i class="fa fa-check"></i> SAVE CHANGES</button>
            </div>
        </div>
    </div>
</div>