<div class="modal fade" id="approver_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">@{{ formTitle }}</h4>
            </div>
            <div class="modal-body">
                <form v-on:keyup.enter="storeItem">
                    <input type="hidden" v-model="form.approver_id">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="approver_name">Approver Name</label>
                            <input type="text" class="form-control" id="approver_name" v-model="form.approver_name">
    
                            <span v-if="errors.approver_name" class="text-danger">
                                @{{ errors.approver_name[0] }}
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" class="form-control" id="position" v-model="form.position">
    
                            <span v-if="errors.position" class="text-danger">
                                @{{ errors.position[0] }}
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-flat btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                <button v-on:click="saveItem" type="button" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-check"></i> Save changes</button>
            </div>
        </div>
    </div>
</div>