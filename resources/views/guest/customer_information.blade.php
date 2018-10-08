<div class="card">
    <h5 class="card-header">I. Fleet Customer Information</h5>
    <div class="card-body">
        <div class="form-row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="company_name">
                        Company Name
                        <span class="text-danger">*</span>
                    </label>
                    <input v-model="form.company_name" type="text" class="form-control" id="company_name" aria-describedby="textHelp">
                </div>

                <div class="form-group">
                    <label for="office_address">
                        Office Address
                        <span class="text-danger">*</span>
                    </label>
                    <input v-model="form.office_address" type="text" class="form-control" id="office_address" aria-describedby="textHelp">
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contact_person">
                                Contact Person
                                <span class="text-danger">*</span>
                            </label>
                            <input v-model="form.contact_person" type="text" class="form-control" id="contact_person" aria-describedby="textHelp">
                        </div>
                        <div class="form-group">
                            <label for="email">
                                Email Address
                                <span class="text-danger">*</span>
                            </label>
                            <input v-model="form.email" type="email" class="form-control" id="email" aria-describedby="textHelp">
                        </div>
                        
                        <div class="form-group">
                            <label for="selling_dealer">Selling Dealer</label>
                            <select 
                            v-model="form.selling_dealer"
                            class="selectpicker" 
                            multiple data-live-search="true"
                            multiple data-selected-text-format="count > 3"
                            title="Click to pick items"
                            data-style="btn-info"
                            data-width="100%"
                            data-size="6">
                                <option v-for="(item, index) in dealers" v-bind:value="`${item.dealer}|${item.branch}`">
                                    @{{item.dealer}} | @{{item.branch}}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input v-model="form.position" type="text" class="form-control" id="position" aria-describedby="textHelp">
                        </div>
                        <div class="form-group">
                            <label for="contact_number">
                                Contact Number
                                <span class="text-danger">*</span>
                            </label>
                            <input v-model="form.contact_number" type="text" class="form-control" id="contact_number" aria-describedby="textHelp">
                        </div>
                        <div class="form-group">
                            <label for="unit_models">Isuzu Specific Unit Model</label>
                            <select 
                            v-model="form.unit_models"
                            class="selectpicker" 
                            multiple data-live-search="true" 
                            multiple data-selected-text-format="count > 3"
                            title="Click to pick items"
                            data-style="btn-info"
                            data-width="100%"
                            data-size="6">
                                <option v-for="(item, index) in unit_models" v-bind:value="item.model_name">
                                    @{{ item.model_name }}
                                </option>
                            </select>

                            {{-- <select v-model="form.unit_models" class="custom-select" size="5" multiple>
                                <option v-for="(item, index) in unit_models" v-bind:value="item.model_name">@{{ item.model_name }}</option>
                            </select> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>