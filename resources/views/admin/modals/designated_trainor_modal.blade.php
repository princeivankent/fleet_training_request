<div class="modal fade" id="designated_trainor_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Trainors</h4>
            </div>
            <div class="modal-body">
                <table id="designated_trainors" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase">#</th>
                            <th class="text-center text-uppercase">Trainor</th>
                            <th class="text-center text-uppercase">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in designated_trainors" v-bind:key="index">
                            <td class="text-center">@{{ index+1 }}</td>
                            <td class="text-center">@{{ item.lname }}, @{{ item.fname }} @{{ item.mname }}</td>
                            <td class="text-center">
                                <button 
                                v-if="item.designated_trainors.length > 0"
                                v-on:click="excludeTrainor(item.trainor_id)"
                                class="btn btn-xs btn-success">
                                    <i class="fa fa-check"></i>
                                </button>
                                <button 
                                v-else 
                                v-on:click="includeTrainor(item.trainor_id)"
                                class="btn btn-xs btn-danger">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button 
                class="btn btn-sm btn-success" 
                v-on:click="willApprove"
                :disabled="training_request.request_status == 'pending' ? false : true">
                    <i class="fa fa-check-circle"></i>&nbsp;
                    Approve Request
                </button>
            </div>
        </div>
    </div>
</div>