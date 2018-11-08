<div class="modal fade" id="special_training_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">@{{ form_title }}</h4>
            </div>
            <div class="modal-body">
                <form v-on:submit.prevent="saveSpecialTraining">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Program Title</label>
                                <input type='text' class="form-control" v-model="program_title"/>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-flat btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                <button v-on:click="saveSpecialTraining" type="button" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-check"></i> Save changes</button>
            </div>
        </div>
    </div>
</div>