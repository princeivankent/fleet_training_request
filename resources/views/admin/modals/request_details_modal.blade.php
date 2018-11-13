<div class="modal fade" id="request_details_modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Request Details</h4>
			</div>
			<div class="modal-body">
				<!-- FLEET CUSTOMER INFORMATION -->
				<div class="box box-solid">
					<div class="box-header with-border">
						<h3 class="box-title text-danger">Fleet Customer Information</h3>
					</div>
					<div class="box-body row">
						<div class="form-group col-md-6">
							<label>Company Name</label>
							<input type="text" v-model="training_request.company_name" class="form-control" readonly>
						</div>
						<div class="form-group col-md-6">
							<label>Office Address</label>
							<input type="text" v-model="training_request.office_address" class="form-control" readonly>
						</div>
						<div class="form-group col-md-6">
							<label>Contact Person</label>
							<input type="text" v-model="training_request.contact_person" class="form-control" readonly>
						</div>
						<div class="form-group col-md-6">
							<label>Position</label>
							<input type="text" v-model="training_request.position" class="form-control" readonly>
						</div>
						<div class="form-group col-md-6">
							<label>Email Address</label>
							<input type="text" v-model="training_request.email" class="form-control" readonly>
						</div>

						<div class="form-group col-md-6">
							<label>Contact No</label>
							<input type="text" v-model="training_request.contact_number" class="form-control" readonly>
						</div>
						<div class="form-group col-md-6">
							<label>Selling Dealer</label>
							<ul class="list-group">
								<li class="list-group-item" v-for="item in training_request.customer_dealers">
									<i class="fa fa-check-circle"></i>&nbsp;
									@{{ item.dealer }} | @{{ item.branch }}
								</li>
							</ul>
						</div>
						<div class="form-group col-md-6">
							<label>Isuzu Specific Model</label>
							<ul class="list-group">
								<li class="list-group-item" v-for="item in training_request.customer_models">
									<i class="fa fa-check-circle"></i>&nbsp;
									@{{ item.model }}
								</li>
							</ul>
						</div>
					</div>
				</div>

				<!-- TRAINING INFORMATION -->
				<div class="box box-solid">
					<div class="box-header with-border">
						<h3 class="box-title text-danger">Training Information</h3>
					</div>
					<div class="box-body row">
						<div class="form-group col-md-7">
							<label>Training Participants</label>
							<ul class="list-group">
								<li class="list-group-item" v-for="item in training_request.customer_participants">
									<i class="fa fa-check-circle"></i>&nbsp;
									@{{ item.participant }} (@{{ item.quantity }})
								</li>
							</ul>
						</div>
						<div class="form-group col-md-5">
							<label>Request Training Date</label>
							<input type="text" v-bind:value="training_request.training_date | dateTimeFormat" class="form-control" readonly>
						</div>
						<div class="form-group col-md-5">
							<label>Training Venue</label>
							<input type="text" v-model="training_request.training_venue" class="form-control" readonly>
						</div>
						<div class="form-group col-md-7">
							<label>Address of Training Venue</label>
							<input type="text" v-model="training_request.training_address" class="form-control" readonly>
						</div>
					</div>
				</div>

				<!-- TRAINING PROGRAM OFFERINGS -->
				<div class="box box-solid">
					<div class="box-header with-border">
						<h3 class="box-title text-danger">Training Program</h3>
					</div>
					<div class="box-body row">
						<div class="form-group col-md-7">
							<label>Training Program</label>
							<input v-if="data_loaded" type="text" v-model="training_request.training_program.program_title" class="form-control" readonly>
						</div>
						<div class="form-group col-md-5">
							<label>Isuzu Specific Model</label>
							<input v-if="data_loaded" type="text" v-model="training_request.unit_model.model_name" class="form-control" readonly>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-flat btn-danger" v-on:click="willDeny(training_request.training_request_id)" :disabled="training_request.request_status == 'pending' ? false : true"><i class="fa fa-times"></i> Deny</button>
				<button type="button" class="btn btn-sm btn-flat btn-primary" v-on:click="showDesignatedTrainors(training_request.training_request_id)" :disabled="training_request.request_status == 'pending' ? false : true"><i class="fa fa-check"></i> Approve</button>
			</div>
		</div>
</div>
</div>