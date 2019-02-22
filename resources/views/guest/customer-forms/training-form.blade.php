<div class="card" style="height: 480px;">
	<h5 class="card-header">Part C. Training Information</h5>
	<div class="card-body">
		<div class="form-row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="training_date">
								Request Training Date
								<span class="text-danger">*</span>
							</label>
							<input v-on:blur="getDate" v-model="form.training_date" type="text" class="form-control" id="training-date" v-on:keyup="dateTyped">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="training_venue">
								Training Venue
								<span class="text-danger">*</span>
							</label>
							<select 
							v-model="form.training_venue"
							class="selectpicker" 
							data-live-search="true"
							title="Click to pick items"
							data-style="btn-info"
							data-width="100%"
							data-size="6">
								<option value="Fleet Customer">Fleet Customer</option>
								<option value="IPC">IPC</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="training_address">
								Address of Training Venue
								<span class="text-danger">*</span>
							</label>
							<input v-model="form.training_address" type="text" class="form-control" id="training_address" aria-describedby="textHelp">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-12">
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
									<tr v-for="(item, index) in form.training_participants">
										<td class="text-center">@{{ item.participant }}</td>
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
											<select 
											v-model="participants.participant"
											v-on:change="others"
											class="custom-select text-center" >
												<option selected></option>
												<option value="Driver">Driver</option>
												<option value="Mechanic">Mechanic</option>
												<option value="Fleet Head">Fleet Head</option>
												<option value="others">Others</option>
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
				</div>
			</div>
			<div class="col-md-3"></div>
		</div>
	</div>
</div>

@include('guest.dialogs.participants')