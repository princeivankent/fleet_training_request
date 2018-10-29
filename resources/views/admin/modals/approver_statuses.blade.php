<div class="modal fade" id="approver_statuses">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Approver Statuses</h4>
            </div>
            <div class="modal-body">
                <table id="training_requests" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase">&nbsp;</th>
                            <th class="text-center text-uppercase">Approver</th>
                            <th class="text-center text-uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in approval_statuses" v-bind:key="item.approval_status_id">
                            <td class="text-center">@{{ index+1 }}</td>
                            <td class="text-center">@{{ item.approver.approver_name }}</td>
                            <td class="text-center">
                                <div v-if="item.status == 'pending'" class="label label-warning">
                                    @{{ item.status }}
                                </div>
                                <div v-else-if="item.status == 'approved'" class="label label-success">
                                    @{{ item.status }}
                                </div>
                                <div v-else class="label label-danger">
                                    @{{ item.status }}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>