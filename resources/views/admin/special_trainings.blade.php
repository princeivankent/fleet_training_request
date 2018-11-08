@extends('layouts.admin_layout')

@push('styles')
	<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="{{ url('public/libraries/css/viewer.min.css') }}">
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
		<h1>Special Training Programs</h1>
	</section>
	
	<section class="content container-fluid">
		<div class="box box-primary shadow-lg">
			<div class="box-header with-border clearfix">
				<h3 class="box-title"><i class="fa fa-th-list"></i> List of Training Programs</h3>
				<button 
				v-on:click="createSpecialTraining"
				class="btn btn-sm btn-flat btn-default pull-right">
					<i class="fa fa-plus-circle"></i>
					ADD PROGRAM
				</button>
			</div>
			<div class="box-body">
				<div class="form-row">
					<div v-for="(item, index) in special_trainings" 
					class="col-md-4">
						<div class="card raleway shadow" style="margin-bottom: 12px;">
							<div class="card-header bg-white">
								<div class="row">
									<div class="col-md-7">
										<h4 class="card-title text-bold">
											<span class="text-primary">@{{ item.program_title }}</span>
										</h4>
									</div>
								</div>
								{{-- <small style="color: #9C9D9E">@{{ item.description }}</small> --}}
							</div>
                            <div class="card-body">
                                <button 
                                v-on:click="deleteSpecialTraining(item.special_training_id, index)"
                                class="btn btn-sm btn-default pull-right ml-3">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button 
                                v-on:click="updateSpecialTraining(item.special_training_id)"
                                class="btn btn-sm btn-default pull-right ml-3">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button 
                                v-on:click="openImages(item.special_training_id)"
                                class="btn btn-sm btn-default pull-right">
                                    <i class="fa fa-image"></i>
                                </button>
                            </div>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer"></div>
		</div>
	</section>

	@include('admin.modals.special_training_modal')
	@include('admin.modals.special_training_images')
</div>
@endsection

@push('scripts')
	<script src="{{ url('public/libraries/js/viewer.min.js') }}"></script>
	<script>
		new Vue({
			el: '#app',
			data() {
				return {
                    is_edit:boolean = 0,
                    special_trainings:array = [],
                    special_training_images:array = [],
                    special_training_id:number = 0,
                    program_title:string = '',
                    form_title:string = 'Create Special Training Program',
                    image:string = '',
                    images:array = [],
                    errors: []
				}
			},
            watch: {
                is_edit() {
                    if (this.is_edit) return;
                    else return this.program_title = null;
                }
            },
			created() {
                this.getSpecialTrainings();
			},
			methods: {
                openImages: function(special_training_id) {
                    this.special_training_id = special_training_id;
                    axios.get(`${this.base_url}/admin/special_training_images/get/${special_training_id}`)
                    .then(({data}) => {
                        $('#special_training_images').modal('show');
                        this.special_training_images = data;
                    })
                    .catch((error) => {
                        console.log(error.response);
                    });
                },
                onImageChange: function(e) {
					let files = e.target.files || e.dataTransfer.files;
					if (!files.length) return;
					this.createImage(files[0]);
				},
				createImage: function(file) {
					let reader = new FileReader();
					let vm = this;
					reader.onload = (e) => {
						vm.image = e.target.result;
					};
					reader.readAsDataURL(file);
				},
				uploadImage: function() {
                    if ($('#image').val() != '') {
                        var uri = `${this.base_url}/admin/special_training_images/post`;
                        axios.post(uri, {
                            image: this.image,
                            special_training_id: this.special_training_id
                        })
                        .then(({data}) => {
                            this.openImages(this.special_training_id);
                            swal('Alright!', 'Image has been successfully uploaded.', 'success', {timer:4000,button:false});
                            $('#image').val('');
                        })
                        .catch((error) => {
                            this.errors = error.response.data;
                            console.log(error.response);
                        });
                    }
				},
                deleteImage: function(special_training_image_id, index) {
                    swal({
                        title: "Delete this image?",
                        text: "",
                        icon: "warning",
                        buttons: {
                            cancel: true,
                            confirm: 'Proceed'
                        },
                        closeOnClickOutside: false
                    })
                    .then((res) => {
                        if (res) {
                            return axios.delete(`${this.base_url}/admin/special_training_images/delete/${special_training_image_id}`)
                                .then(({data}) => {
                                    if (data) {
                                        this.openImages(this.special_training_id);
                                        swal('Alright!', 'Image has been deleted.', 'success', {timer:4000,button:false});
                                    }
                                })
                                .catch((error) => {
                                    console.log(error.response);
                                    swal('Ooops!', 'Something went wrong.', 'error', {timer:4000,button:false});
                                });
                        }
                    });
                },
                // ----------------------------------------------------------------------- //
				getSpecialTrainings: function() {
                    axios.get(`${this.base_url}/admin/special_trainings/get`)
                    .then(({data}) => {
                        this.special_trainings = data;
                    })
                    .catch((error) => {
                        console.log(error.response);
                    });
                },
                createSpecialTraining: function() {
                    this.is_edit = 0;
                    $('#special_training_modal').modal('show');
                },
                updateSpecialTraining: function(special_training_id) {
                    this.is_edit = 1;
                    axios.get(`${this.base_url}/admin/special_trainings/get/${special_training_id}`)
                    .then(({data}) => {
                        this.special_training_id = data.special_training_id;
                        this.program_title = data.program_title;
                    })
                    .catch((error) => {
                        console.log(error.response);
                        swal('Ooops!', 'Something went wrong.', 'error', {timer:4000,button:false});
                    });
                    $('#special_training_modal').modal('show');
                },
                saveSpecialTraining: function() {
                    if (this.is_edit) 
                        return axios.put(`${this.base_url}/admin/special_trainings/put/${this.special_training_id}`, {program_title: this.program_title})
                            .then(({data}) => {
                                if (data) {
                                    $('#special_training_modal').modal('hide');
                                    this.getSpecialTrainings();
                                    swal('Success!', 'Special Training Program has been saved.', 'success', {timer:4000,button:false});
                                }
                            })
                            .catch((error) => {
                                console.log(error.response);
                                swal('Ooops!', 'Something went wrong.', 'error', {timer:4000,button:false});
                            });
                    else 
                    return axios.post(`${this.base_url}/admin/special_trainings/post`, {program_title: this.program_title})
                        .then(({data}) => {
                            if (data) {
                                this.program_title = '';
                                this.getSpecialTrainings();
                                swal('Success!', 'Special Training Program has been saved.', 'success', {timer:4000,button:false});
                            }
                        })
                    .catch((error) => {
                        console.log(error.response);
                        swal('Ooops!', 'Something went wrong.', 'error', {timer:4000,button:false});
                    });
                },
                deleteSpecialTraining: function(special_training_id, index) {
                    swal({
                        title: "Delete this Special Training?",
                        text: "",
                        icon: "warning",
                        buttons: {
                            cancel: true,
                            confirm: 'Proceed'
                        },
                        closeOnClickOutside: false
                    })
                    .then((res) => {
                        if (res) {
                            axios.delete(`${this.base_url}/admin/special_trainings/delete/${special_training_id}`)
                            .then(({data}) => {
                                if (data) {
                                    this.getSpecialTrainings();
                                    swal('Success!', 'Special Training Program has been deleted.', 'success', {timer:4000,button:false});
                                }
                            })
                            .catch((error) => {
                                console.log(error.response);
                                swal('Ooops!', 'Something went wrong.', 'error', {timer:4000,button:false});
                            });
                        }
                    });
                }
			}
        })
		document.querySelector('#special_training_tab').setAttribute('class', 'active');
	</script>
@endpush