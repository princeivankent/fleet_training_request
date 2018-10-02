<div class="card my-4">
    <h5 class="card-header">II. Training Information</h5>
    <div class="card-body">
        <div class="form-row">
            <div class="col-md-3"></div>
            <div class="col-md-6">

                {{-- <div class="form-group">
                    <label for="company_name">Company Name</label>
                    <input v-model="company_name" type="text" class="form-control" id="company_name" aria-describedby="textHelp">
                </div>

                <div class="form-group">
                    <label for="office_address">Office Address</label>
                    <input type="text" class="form-control" id="office_address" aria-describedby="textHelp">
                </div> --}}

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="training_participants">
                                Training Participants
                                <span class="text-danger">*</span>
                            </label>
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Participants</th>
                                        <th scope="col">Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in training_participants">
                                        <td>@{{ item.participants }}</td>
                                        <td>@{{ item.quantity }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select class="custom-select">
                                                <option selected>Open this select menu</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" aria-describedby="textHelp">
                        </div>
                        
                        <div class="form-group">
                            <label for="contact_number">Selling Dealer</label>
                            <select class="selectpicker" 
                            multiple data-live-search="true" 
                            multiple data-selected-text-format="count > 4"
                            data-width="100%"
                            data-size="6">
                                <option data-content="<span class='badge badge-info' style='padding: 7px;'>Relish</span>">Mustard</option>
                                <option data-content="<span class='badge badge-info' style='padding: 7px;'>Relish</span>">Ketchup</option>
                                <option data-content="<span class='badge badge-info' style='padding: 7px;'>Relish</span>">Relish</option>
                                <option data-content="<span class='badge badge-info' style='padding: 7px;'>Relish</span>">Relish</option>
                                <option data-content="<span class='badge badge-info' style='padding: 7px;'>Relish</span>">Relish</option>
                            </select>
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
                        <div class="form-group">
                            <label for="contact_number">Contact Number</label>
                            <input type="text" class="form-control" id="contact_number" aria-describedby="textHelp">
                        </div>
                        <div class="form-group">
                            <label for="unit_models">Isuzu Specific Unit Model</label>
                            <select class="selectpicker" multiple data-live-search="true" 
                            data-style="btn-info"
                            data-width="100%"
                            data-size="6">
                                <option>Mustard</option>
                                <option>Ketchup</option>
                                <option>Relish</option>
                                <option>Relish</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>