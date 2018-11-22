<div class="modal fade" id="scheduler_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <i class="fa fa-plus"></i>&nbsp;
                    Create Schedule
                </h4>
            </div>
            <div class="modal-body">
                <form v-on:keyup.enter="">
                <form v-on:keyup.enter="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Start Date</label>
                                <div class='input-group'>
                                    <input type='date' class="form-control" v-model="form.start_date">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>End Date</label>
                                <div class='input-group date'>
                                    <input type='date' class="form-control" v-model="form.end_date"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Reason/Appointment</label>
                                <textarea class="form-control" 
                                name="reason" id="reason" v-model="form.reason"
                                cols="30" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-flat btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                <button v-on:click="saveSchedule" type="button" class="btn btn-sm btn-flat btn-success"><i class="fa fa-check"></i> Save changes</button>
            </div>
        </div>
    </div>
</div>