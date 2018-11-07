@extends('layouts.admin_layout')

@push('styles')
	<link rel="stylesheet" href="{{ url('public/libraries/adminlte/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
<div v-cloak>
	<section class="content container-fluid">
		<div class="row">
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-aqua shadow">
					<div class="inner">
						<h3>@{{ training_requests.all_requests }}</h3>
	
						<p>Total Requests</p>
					</div>
					<div class="icon">
						<i class="ion ion-android-list"></i>
					</div>
					<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
	
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-green shadow">
					<div class="inner">
						{{-- <h3>53<sup style="font-size: 20px">%</sup></h3> --}}
						<h3>@{{ training_requests.approved_requests }}</h3>
	
						<p>Approved Requests</p>
					</div>
					<div class="icon">
						<i class="ion ion-thumbsup"></i>
					</div>
					<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-yellow shadow">
					<div class="inner">
						<h3>@{{ training_requests.pending_requests }}</h3>
	
						<p>Pending Requests</p>
					</div>
					<div class="icon">
						<i class="ion ion-android-notifications"></i>
					</div>
					<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-red shadow">
					<div class="inner">
						<h3>@{{ training_requests.denied_requests }}</h3>
	
						<p>Denied Requests</p>
					</div>
					<div class="icon">
						<i class="ion ion-thumbsdown"></i>
					</div>
					<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div>
	
		<div class="box box-primary shadow-lg">
			<div class="box-header with-border">
				<h3 class="box-title">Training Requests</h3>
			</div>
			<div class="box-body">
				<table id="training_requests" class="table table-responsive table-bordered table-hover" width="100%">
					<thead>
						<tr>
							<th class="text-center text-uppercase">&nbsp;</th>
							<th class="text-center text-uppercase">Company Name</th>
							<th class="text-center text-uppercase">Contact Person</th>
							<th class="text-center text-uppercase">Email</th>
							<th class="text-center text-uppercase">Contact Number</th>
							<th class="text-center text-uppercase">Requesting For</th>
							<th class="text-center text-uppercase">Training Date</th>
							<th class="text-center text-uppercase">Admin</th>
							<th class="text-center text-uppercase">Requestor</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(item, index) in items" v-bind:key="item.training_request_id">
							<td class="text-center">
								<!-- Split button -->
								<div class="btn-group">
									<button type="button" class="btn btn-sm btn-primary dropdown-toggle py-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fa fa-ellipsis-h"></i>
									</button>
									<ul class="dropdown-menu shadow-lg">
										<li class="text-left"><a href="#" v-on:click="openRequest(item.training_request_id)">
											<i class="fa fa-folder-open text-yellow"></i>
											Open Request
										</a></li>
										<li v-if="item.request_status == 'approved'" class="text-left"><a href="#" v-on:click="getApproverStatuses(item.training_request_id)">
											<i class="fa fa-th-list text-primary"></i>
											Approver Statuses
										</a></li>

										<li v-if="item.request_status != 'denied'" role="separator" class="divider"></li>
										<li v-if="item.request_status != 'denied' && item.request_status != 'approved'" class="dropdown-header">Your actions</li>
										<li v-if="item.request_status == 'approved'" class="text-center">
											<div class="label label-success" style="pading: 8px;">
												<i class="fa fa-check-circle"></i> &nbsp;
												already approved
											</div>
										</li>
										<li v-if="item.request_status != 'denied' && item.request_status != 'approved'" class="text-left"><a href="#" v-on:click="willApprove(item.training_request_id)">
											<i class="fa fa-check text-success"></i>&nbsp;
											Approve
										</a></li>
										<li v-if="item.request_status != 'denied' && item.request_status != 'approved'" class="text-left"><a href="#" v-on:click="willDeny(item.training_request_id)">
											<i class="fa fa-times text-danger"></i>
											Disapprove</a>
										</li>
									</ul>
								</div>
							</td>
							<td class="text-center">@{{ item.company_name }}</td>
							<td class="text-center">@{{ item.contact_person }}</td>
							<td class="text-center">@{{ item.email }}</td>
							<td class="text-center">@{{ item.contact_person }}</td>
							<td class="text-center">@{{ item.training_program.program_title }}</td>
							<td class="text-center">@{{ item.training_date | dateTimeFormat }}</td>
							<td class="text-center">
								<div v-if="item.request_status == 'approved'" class="label label-success">
									@{{ item.request_status }}
								</div>
								<div v-else-if="item.request_status == 'pending'" class="label label-warning">
									@{{ item.request_status }}
								</div>
								<div v-else class="label label-danger">
									@{{ item.request_status }}
								</div>
							</td>
							<td class="text-center">
								<div v-if="item.requestor_confirmation == 'confirmed'" class="label label-success">
									@{{ item.requestor_confirmation }}
								</div>
								<div v-else-if="item.requestor_confirmation == 'pending'" class="label label-warning">
									waiting
								</div>
								<div v-else class="label label-danger">
									@{{ item.requestor_confirmation }}
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</section>
</div>
@include('admin.modals.request_details_modal')
@include('admin.modals.approver_statuses')
@endsection

@push('scripts')
	<script src="{{ url('public/libraries/adminlte/jquery.dataTables.min.js') }}"></script>
	<script src="{{ url('public/libraries/adminlte/dataTables.bootstrap.min.js') }}"></script>
	<script>
		new Vue({
			el: '#app',
			data() {
				return {
					training_requests: {},
					data_loaded: 0,
					items: [],
					training_request: {},
					approval_statuses: []
				}
			},
			created() {
				this.getDashboard();
				this.getItems();
			},
			methods: {
				getDashboard() {
					axios.get(`${this.base_url}/admin/training_requests_statuses`)
					.then(({data}) => {
						this.training_requests = data;
					})
					.catch((error) => {
						console.log(error.response);
					});
				},
				getApproverStatuses(training_request_id) {
					axios.get(`${this.base_url}/admin/approver_statuses/${training_request_id}`)
					.then(({data}) => {
						this.approval_statuses = data;
						$('#approver_statuses').modal('show');
					})
					.catch((error) => {
						console.log(error.response);
					});
				},
				getItems() {
					return axios.get(`${this.base_url}/admin/training_requests/get`)
					.then(({data}) => {
						this.items = data;
						
						setTimeout(() => {
							$('#training_requests').DataTable();
						});
					})
					.catch((error) => {
						console.log(error.response)
					});
				},
				openRequest(training_request_id) {
					axios.get(`${this.base_url}/admin/training_requests/get/${training_request_id}`)
					.then(({data}) => {
						this.training_request = data;
						this.data_loaded = 1;
						$('#request_details_modal').modal('show');
					})
					.catch((error) => {
						console.log(error.response);
					});
				},
				willApprove(training_request_id) {
					swal({
						title: "Accept Request?",
						text: "Once approved, it will automatically send email to next approver",
						icon: "warning",
						closeOnClickOutside: false,
						buttons: {
							cancel: true,
							confirm: 'Approve'
						},
					})
					.then((res) => {
						if (res) {
							axios.put(`${this.base_url}/admin/update_request/${training_request_id}`, {request_status: 'approved'})
							.then(({data}) => {
								if (data) {
									this.getItems();
									swal({
										title: "Alright!",
										text: "Request has been approved",
										icon: "success",
										button: false,
										timer: 4000,
									})
								}
							})
							.catch((error) => {
								console.log(error.response);
							});
						}
					});
				},
				willDeny(training_request_id) {
					swal({
						title: "Disapprove Request?",
						text: "Note: you can not undo changes after it.",
						icon: "error",
						dangerMode: true,
						closeOnClickOutside: false,
						buttons: {
							cancel: true,
							confirm: 'Yes please'
						},
					})
					.then((data) => {
						if (data) {
							axios.put(`${this.base_url}/admin/update_request/${training_request_id}`, {request_status: 'denied'})
							.then(({data}) => {
								if (data) {
									this.getItems();
									swal('Success!', 'Request has been denied', 'success', {timer:4000,button:false});
								}
							})
							.catch((error) => {
								console.log(error.response);
								swal('Ooops!', 'Something went wrong.', 'error', {timer:4000,button:false});
							});
						}
					});
				},
			}
		})
		document.querySelector('#training_requests_tab').setAttribute('class', 'active');
	</script>
@endpush