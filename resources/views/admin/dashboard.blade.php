@extends('layouts.admin_layout')

@push('styles')
	<link rel="stylesheet" href="{{ url('public/libraries/adminlte/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
<div v-cloak>
	<section class="content-header">
		<h1>Administrator's Dashboard</h1>
	</section>
	
	<section class="content container-fluid">
		<div class="row">
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-aqua shadow">
					<div class="inner">
						<h3>0</h3>
	
						<p>All Requests</p>
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
						<h3>0</h3>
	
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
				<div class="small-box bg-yellow shadow">
					<div class="inner">
						<h3>0</h3>
	
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
				<div class="small-box bg-red shadow">
					<div class="inner">
						<h3>0</h3>
	
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
				<h3 class="box-title">Customer's Requests</h3>
			</div>
			<div class="box-body">
				<table id="training_requests" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th class="text-center text-uppercase">&nbsp;</th>
							<th class="text-center text-uppercase">Company Name</th>
							<th class="text-center text-uppercase">Contact Person</th>
							<th class="text-center text-uppercase">Email</th>
							<th class="text-center text-uppercase">Contact Number</th>
							<th class="text-center text-uppercase">Requesting For</th>
							<th class="text-center text-uppercase">Training Date</th>
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
										<li class="text-left"><a href="#" v-on:click="willApprove(item.training_request_id)">
											<i class="fa fa-check text-success"></i>
											Approve
										</a></li>
										<li class="text-left"><a href="#" v-on:click="willDeny(item.training_request_id)">
											<i class="fa fa-times text-danger"></i>
											Deny</a>
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
						</tr>
					</tbody>
				</table>
			</div>
			<div class="box-footer clearfix">
				<button v-on:click="getItems" class="btn btn-sm btn-primary pull-right">REFRESH</button>
			</div>
		</div>
	</section>
</div>
@endsection

@push('scripts')
	<script src="{{ url('public/libraries/adminlte/jquery.dataTables.min.js') }}"></script>
	<script src="{{ url('public/libraries/adminlte/dataTables.bootstrap.min.js') }}"></script>
	<script>
		new Vue({
			el: '#app',
			data() {
				return {
					items: []
				}
			},
			created() {
				this.displayItems();
			},
			methods: {
				displayItems() {
					return this.getItems()
					.then((data) => {
						$('#training_requests').DataTable({
							"paging": true,
							// "ordering": false,
							"info": true,
							"autoWidth": false
						});
					});
				},
				getItems() {
					return axios.get(`${this.base_url}/admin/training_requests/get`)
					.then(({data}) => {
						this.items = data;
					})
					.catch((error) => {
						console.log(error.response)
					});
				},
				willApprove(training_request_id) {
					swal({
						title: "Accept Request?",
						text: "Once approved, it will automatically send email to next approver",
						icon: "warning",
						buttons: {
							cancel: true,
							confirm: 'Approve'
						},
					})
					.then((data) => {
						if (data) {
							swal('Success', 'Request has been approved', 'success');
						}
					});
				},
				willDeny(training_request_id) {
					swal({
						title: "Deny Request?",
						text: "you need to specify reason for an email response",
						icon: "error",
						dangerMode: true,
						buttons: {
							cancel: true,
							confirm: 'Yes please'
						},
					})
					.then((data) => {
						if (data) {
							swal('Success', 'Request has been denied', 'info');
						}
					});
				},
			}
		})
		document.querySelector('#dashboard_tab').setAttribute('class', 'active');
	</script>
@endpush