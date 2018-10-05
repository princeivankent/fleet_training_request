@extends('layouts.admin_layout')

@push('styles')
	<link rel="stylesheet" href="{{ url('public/libraries/adminlte/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
<div v-cloak>
	<section class="content-header">
		<h1>
			Administrator's Dashboard
		</h1>
	</section>
	
	<section class="content container-fluid">
		<div class="row">
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3>120</h3>
	
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
				<div class="small-box bg-green">
					<div class="inner">
						{{-- <h3>53<sup style="font-size: 20px">%</sup></h3> --}}
						<h3>53</h3>
	
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
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3>44</h3>
	
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
				<div class="small-box bg-red">
					<div class="inner">
						<h3>65</h3>
	
						<p>Denied Requests</p>
					</div>
					<div class="icon">
						<i class="ion ion-thumbsdown"></i>
					</div>
					<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div>
	
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Customer's Requests</h3>
			</div>
			<div class="box-body">
				<table class="table table-bordered table-hover">
					<thead>
					<tr>
						<th>Rendering engine</th>
						<th>Browser</th>
						<th>Platform(s)</th>
						<th>Engine version</th>
						<th>CSS grade</th>
					</tr>
					</thead>
					<tbody>
						<tr>
						<td>Trident</td>
						<td>Internet
							Explorer 4.0
						</td>
						<td>Win 95+</td>
						<td> 4</td>
						<td>X</td>
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
				return {}
			},
			created() {
				this.getItems();
			},
			methods: {
				getItems() {
					$('.table').DataTable({
						destroy: true,
						info: false
					});
				}
			}
		})
		$('#dashboard_tab').addClass('active');
	</script>
@endpush