@extends('layouts.admin_layout')

@push('styles')
	<link rel="stylesheet" href="{{ url('public/libraries/adminlte/dataTables.bootstrap.min.css') }}">
	<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700" rel="stylesheet" type="text/css">
	<style>
		.raleway {
			color: #636b6f;
			font-family: 'Raleway', sans-serif;
			font-weight: 600;
		}
	</style>
@endpush

@section('content')
<div v-cloak>
	<section class="content-header">
		<h1>Training Programs</h1>
	</section>
	
	<section class="content container-fluid">
		<div class="box box-primary shadow-lg">
			<div class="box-header with-border clearfix">
				<h3 class="box-title"><i class="fa fa-th-list"></i> List of Training Programs</h3>
				<button 
				v-on:click="createTrainingProgram"
				class="btn btn-sm btn-flat btn-default pull-right">
					<i class="fa fa-plus-circle"></i>
					ADD PROGRAM
				</button>
			</div>
			<div class="box-body">
				<div class="form-row">
					<div v-for="(item, index) in items" 
					class="col-md-4">
						<div class="card raleway shadow" style="min-height: 220px; margin-bottom: 12px;">
							<div class="card-header bg-white">
								<div class="row">
									<div class="col-md-9">
										<h4 class="card-title text-bold">
											<span class="text-primary">@{{ item.program_title }}</span>
										</h4>
									</div>
									<div class="col-md-3 clearfix mt-3">
										<button 
										v-on:click="deleteItem(item.training_program_id, index)"
										class="btn btn-sm btn-default pull-right ml-3" 
										style="margin-top: -10px; margin-right: -4px;">
											<i class="fa fa-trash"></i>
										</button>
										<button 
										v-on:click="editTrainingProgram(item.training_program_id)"
										class="btn btn-sm btn-default pull-right" 
										style="margin-top: -10px; margin-right: -4px;">
											<i class="fa fa-pencil"></i>
										</button>
									</div>
								</div>
								<small style="color: #9C9D9E">@{{ item.description }}</small>
							</div>
							<ul class="list-group list-group-flush">
								<li v-for="(item, index) in item.program_features"
								class="list-group-item"><i class="fa fa-caret-right mr-2"></i> @{{ item.feature }}</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer"></div>
		</div>
	</section>

	@include('admin.modals.training_program_modal')
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
					items: [],
					isEdit: 0,
					form: {},
					form_title: '',
					errors: [],
					features: [],
					program_feature_ids: []
				}
			},
			created() {
				this.getItems();
			},
			methods: {
				dataTable() {
					setTimeout(() => {
						$('#training_program_table').DataTable();
					});
				},
				getItems() {
					return axios.get(`${this.base_url}/admin/training_programs/get`)
					.then(({data}) => {
						this.items = data;
							
						if (this.items.length > 0) {
							return this.dataTable();
						}
					})
					.catch((error) => {
						console.log(error.response);
					});
				},
				getItem(training_program_id) {
					axios.get(`${this.base_url}/admin/training_programs/show/${training_program_id}`)
					.then(({data}) => {
						this.form = data;
						this.features = data.program_features;
					})
					.catch((error) => {
						console.log(error.response);
					});
				},
				storeItem() {
					if (this.isEdit) return this.updateItem();

					this.form.features = this.features;
					return axios.post(`${this.base_url}/admin/training_programs/store`, this.form)
					.then(({data}) => {
						this.getItems();
						this.resetForm();
						toastr.success('Successfully added!');
					})
					.catch((error) => {
						this.errors = error.response.data;
						console.log(error.response);
					});
				},
				updateItem() {
					this.form.program_feature_ids = this.program_feature_ids;
					axios.put(`${this.base_url}/admin/training_programs/update/${this.form.training_program_id}`, this.form)
					.then(({data}) => {
						this.getItems();
						toastr.success('Successfully updated!');
					})
					.catch((error) => {
						console.log(error.response);
					});
				},
				deleteItem(training_program_id, index) {
					swal({
						title: "Delete this item?",
						icon: "warning",
						buttons: true,
						dangerMode: true,
					})
					.then((willDelete) => {
						if (willDelete) {
							axios.delete(`${this.base_url}/admin/training_programs/delete/${training_program_id}`)
							.then(({data}) => {
								this.items.splice(index, 1);
								toastr.success('Successfully deleted!');
							})
							.catch((error) => {
								console.log(error.response);
							});
						}
					});
				},
				resetForm() {
					this.features = [];
					this.form = [];
					this.errors = [];
				},
				// --------
				createTrainingProgram() {
					this.form_title = 'Add New Training Program';
					this.isEdit = 0;
					this.errors = [];
					this.form = {};
					this.features = [];
					$('#training_program_modal').modal('show');
				},
				editTrainingProgram(training_program_id) {
					this.form_title = 'Edit Training Program';
					this.isEdit = 1;
					this.errors = [];
					this.features = [];
					this.getItem(training_program_id);
					$('#training_program_modal').modal('show');
				},
				storeFeature() {
					if (this.form.feature) {
						this.features.push({feature: this.form.feature});
						this.form.feature = '';
					}
				},
				removeFeature(program_feature_id, index) {
					this.program_feature_ids.push(program_feature_id);
					this.features.splice(index, 1);
				}
			}
        })
		document.querySelector('#training_program_tab').setAttribute('class', 'active');
	</script>
@endpush