<div class="card my-4">
    <h5 class="card-header">II. Training Information</h5>
    <div class="card-body">
        <div class="form-row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="training_participants">
                                Training Participants
                                <span class="text-danger">*</span>
                            </label>
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">Participants</th>
                                        <th scope="col" width="80" class="text-center">Qty</th>
                                        <th width="20" class="text-center">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in training_participants">
                                        <td class="text-center">@{{ item.participants }}</td>
                                        <td class="text-center">@{{ item.quantity }}</td>
                                        <td class="text-center">
                                            <button v-on:click="remove(index)"
                                            class="btn btn-sm btn-danger">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <select class="custom-select" v-model="participants.participants">
                                                <option selected></option>
                                                <option value="Driver">Driver</option>
                                                <option value="Mechanic">Mechanic</option>
                                                <option value="Fleet Head">Fleet Head</option>
                                                <option v-on:click="others">Others</option>
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <input type="number" class="form-control" v-model="participants.quantity">
                                        </td>
                                        <td class="text-center">
                                            <button v-on:click="add"
                                            class="btn btn-sm btn-success mt-1">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="training_date">
                                Request Training Date
                                <span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control" id="position" aria-describedby="textHelp">
                        </div>
                        <div class="form-group mt-4">
                            <div class="form-group">
                                <label for="training_venue">
                                    Training Venue
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="selectpicker" data-live-search="true"
                                title="Click to pick items"
                                data-style="btn-info"
                                data-width="100%"
                                data-size="6">
                                    <option>Fleet Customer</option>
                                    <option>IPC</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="training_address">
                                Address of Training Venue
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="training_address" aria-describedby="textHelp">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>

@include('guest.participants_dialog')