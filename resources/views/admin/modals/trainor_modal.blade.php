<div class="modal fade" id="trainor_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">@{{ formTitle }}</h4>
            </div>
            <div class="modal-body">
                <form v-on:keyup.enter="">
                    <input type="hidden" v-model="form.trainor_id">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-7">
                                <label for="fname">Firstname</label>
                                <input type="text" class="form-control"
                                v-model="form.fname" id="fname" required>
                            </div>
                            <div class="col-md-5">
                                <label for="mname">Middlename</label>
                                <input type="text" 
                                class="form-control" v-model="form.mname"
                                name="mname" id="mname" placeholder="Optional field">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-7">
                                <label for="lname">Lastname</label>
                                <input type="text" 
                                class="form-control" v-model="form.lname"
                                name="lname" id="lname" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" 
                        class="form-control" v-model="form.email"
                        name="email" id="email" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-flat btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                <button v-on:click="saveTrainor" type="button" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-check"></i> Save changes</button>
            </div>
        </div>
    </div>
</div>