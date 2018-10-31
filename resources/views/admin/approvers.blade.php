@extends('layouts.admin_layout')

@push('styles')
	<link rel="stylesheet" href="{{ url('public/libraries/adminlte/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
<div v-cloak>
	<section class="content-header">
		<h1>Approvers</h1>
	</section>

	<section class="content container-fluid">
		<div class="box box-default shadow-lg">
			<div class="box-header with-border">
				<button
				v-on:click="createItem"
				class="btn btn-sm btn-flat btn-default pull-right">
					<i class="fa fa-plus-circle"></i>
					ADD APPROVER
				</button>
			</div>
			<div class="box-body">
				<table id="approver_table" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th class="text-center text-uppercase"></th>
							<th class="text-center text-uppercase">Approver Name</th>
							<th class="text-center text-uppercase">Email</th>
							<th class="text-center text-uppercase">Position</th>
							<th class="text-center text-uppercase">Created By</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(item, index) in items" v-bind:key="item.training_request_id">
							<td class="text-center">
								<div class="btn-group">
									<button type="button" class="btn btn-sm btn-primary dropdown-toggle py-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fa fa-ellipsis-h"></i>
									</button>
									<ul class="dropdown-menu shadow-lg">
										<li class="text-left"><a v-on:click="editItem(item.approver_id)">
											<i class="fa fa-pencil text-primary"></i>
											Update</a>
										</li>
										<li class="text-left"><a v-on:click="deleteItem(item.approver_id)">
											<i class="fa fa-times text-danger"></i>
											Delete</a>
										</li>
									</ul>
								</div>
							</td>
							<td class="text-center">@{{ item.approver_name }}</td>
							<td class="text-center">@{{ item.email }}</td>
							<td class="text-center">@{{ item.position }}</td>
							<td class="text-center">@{{ item.created_by }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</section>
</div>
@include('admin.modals.approver_modal')
@endsection

@push('scripts')
	<script src="{{ url('public/libraries/adminlte/jquery.dataTables.min.js') }}"></script>
	<script src="{{ url('public/libraries/adminlte/dataTables.bootstrap.min.js') }}"></script>
	<script>
		new Vue({
			el: '#app',
			data() {
				return {
					items: [],
					isEdit: 0,
					formTitle: '',
					form: {},
					errors: []
				}
			},
			created() {
				this.getItems();
			},
			methods: {
				getItems() {
					return axios.get(`${this.base_url}/admin/approvers/get`)
					.then(({data}) => {
						this.items = data;

						setTimeout(() => {
							$('#approver_table').DataTable();
						});
					})
					.catch((error) => {
						console.log(error.response);
					});
				},
				getItem(approver_id) {
					return axios.get(`${this.base_url}/admin/approvers/get/${approver_id}`)
					.then(({data}) => {
						this.form = data;
					})
					.catch((error) => {
						console.log(error.response);
					});
				},
				saveItem() {
					if (this.isEdit) {
						axios.put(`${this.base_url}/admin/approvers/put/${this.form.approver_id}`, this.form)
						.then(({data}) => {
							this.getItems();
							toastr.success('Approver has been updated', 'Success', 'success');
							$('#approver_modal').modal('hide');
						})
						.catch((error) => {
							console.log(error.response);
							this.errors = error.response.data;
						});
					} 
					else {
						axios.post(`${this.base_url}/admin/approvers/post`, this.form)
						.then(({data}) => {
							this.getItems();
							toastr.success('New Approver has been added', 'Success', 'success');
							this.resetForm();
						})
						.catch((error) => {
							console.log(error.response);
							this.errors = error.response.data;
						});
					}
				},
				deleteItem(approver_id) {
					swal({
						title: "Delete this item?",
						icon: "warning",
						buttons: true,
						dangerMode: true,
					})
					.then((data) => {
						if (data) {
							axios.delete(`${this.base_url}//admin/approvers/delete/${approver_id}`)
							.then(({data}) => {
								this.getItems();
								toastr.success('Approver has been deleted', 'Success', 'success');
							})
							.catch((error) => {
								console.log(error.response);
							});
						}
					});
				},
				createItem() {
					this.isEdit = 0;
					this.formTitle = 'Add Approver';
					this.errors = [];
					this.form = {};
					$('#approver_modal').modal('show');
				},
				editItem(approver_id) {
					this.isEdit = 1;
					this.formTitle = 'Update Approver';
					this.errors = [];
					this.getItem(approver_id);
					$('#approver_modal').modal('show');
				},
				resetForm() {
					this.errors = [];
					this.form = {};
				}
			}
		})
	document.querySelector('#approver_tab').setAttribute('class', 'active');
	</script>
@endpush