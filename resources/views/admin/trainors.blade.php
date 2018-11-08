@extends('layouts.admin_layout')

@push('styles')
	<link rel="stylesheet" href="{{ url('public/libraries/adminlte/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
    <div v-cloak>
        <section class="content-header">
            <h1>
                Trainors
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a v-on:click="createTrainor" class="btn btn-sm btn-flat btn-default" style="margin-top: -8px;">
                        <i class="fa fa-plus-circle"></i>&nbsp;
                        ADD TRAINOR
                    </a>
                </li>
            </ol>
        </section>
    
        <section class="content container-fluid">
            <div class="box box-default shadow-lg">
                <div class="box-body">
                    <table id="trainor_table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase" width="50"></th>
                                <th class="text-center text-uppercase">Trainor</th>
                                <th class="text-center text-uppercase">Email</th>
                                <th class="text-center text-uppercase">Created By</th>
                                <th class="text-center text-uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(trainor, index) in trainors" v-bind:key="trainor.trainor_id">
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle py-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </button>
                                        <ul class="dropdown-menu shadow-lg">
                                            <li v-if="trainor.deleted_at" v-on:click="undoDeleteTrainor(trainor.trainor_id)" class="text-left"><a v-on:click="">
                                                <i class="fa fa-undo text-success"></i>
                                                Undo Delete</a>
                                            </li>
                                            <li v-if="trainor.deleted_at" role="separator" class="divider"></li>
                                            <li v-if="trainor.deleted_at == null" class="text-left"><a v-on:click="showTrainor(trainor.trainor_id)">
                                                <i class="fa fa-pencil text-primary"></i>
                                                Update</a>
                                            </li>
                                            <li v-if="trainor.deleted_at == null" 
                                            v-on:click="deleteTrainor(trainor.trainor_id)"
                                            class="text-left"><a v-on:click="">
                                                <i class="fa fa-times text-danger"></i>
                                                Delete</a>
                                            </li>
                                            <li v-if="trainor.deleted_at" v-on:click="confirmDeleteTrainor(trainor.trainor_id)" class="text-left"><a v-on:click="">
                                                <i class="fa fa-times text-danger"></i>
                                                Confirm Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td class="text-center">@{{ trainor.lname }}, @{{ trainor.fname }} @{{ trainor.mname ? trainor.mname : '' }}</td>
                                <td class="text-center">@{{ trainor.email }}</td>
                                <td class="text-center">@{{ trainor.created_by }}</td>
                                <td class="text-center">
                                    <div v-if="trainor.deleted_at" class="label label-danger">
                                        Deleted
                                    </div>
                                    <div v-else class="label label-success">
                                        Active
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@include('admin.modals.trainor_modal')
@endsection

@push('scripts')
    <script src="{{ url('public/libraries/adminlte/jquery.dataTables.min.js') }}"></script>
	<script src="{{ url('public/libraries/adminlte/dataTables.bootstrap.min.js') }}"></script>
    <script>
        new Vue({
            el: '#app',
            data() {
                return {
                    isEdit: 0,
                    trainors: [],
                    form: {}
                }
            },
            computed: {
                formTitle: function() {
                    if (this.isEdit) return 'Update Trainor';
                    else return 'Create Trainor';
                }
            },
            created() {
                this.getTrainors();
            },
            mounted() {
                document.querySelector('#trainor_tab').setAttribute('class', 'active');
            },
            methods: {
                getTrainors: function() {
                    axios.get(`${this.base_url}/admin/trainors/get`)
                    .then(({data}) => {
                        this.trainors = data;

                        setTimeout(() => {
                            $('#trainor_table').DataTable();
                        });
                    })
                    .catch((error) => {
                        console.log(error.response);
                    });
                },
                showTrainor: function(trainor_id) {
                    this.isEdit = 1;

                    axios.get(`${this.base_url}/admin/trainors/get/${trainor_id}`)
                    .then(({data}) => {
                        this.form = data;

                        if (Object.keys(this.form).length != 0) {
                            $('#trainor_modal').modal('show');
                        }
                    })
                    .catch((error) => {
                        console.log(error.response);
                    });
                },
                createTrainor: function() {
                    this.isEdit = 0;
                    this.form = {};
                    $('#trainor_modal').modal('show');
                },
                saveTrainor: function() {
                    if (this.isEdit) {
                        return axios.put(`${this.base_url}/admin/trainors/put/${this.form.trainor_id}`, this.form)
                            .then(({data}) => {
                                this.getTrainors();
                                $('#trainor_modal').modal('hide');
                                swal('Success!', 'Trainor has been updated.', 'success', {timer:4000,button:false});
                            })
                            .catch((error) => {
                                console.log(error.response);
                                swal('Ooops!', 'Something went wrong.', 'error', {timer:4000,button:false});
                            });
                    }
                    
                    return axios.post(`${this.base_url}/admin/trainors/post`, this.form)
                        .then(({data}) => {
                            this.getTrainors();
                            $('#trainor_modal').modal('hide');
                            swal('Success!', 'Trainor Saved', 'success', {timer:4000,button:false});
                        })
                        .catch((error) => {
                            console.log(error.response);
                            swal('Ooops!', 'Something went wrong.', 'error', {timer:4000,button:false});
                        });
                },
                deleteTrainor: function(trainor_id) {
                    swal({
                        title: "Delete this Trainor?",
                        text: "Don't worry, You can bring back what's deleted.",
                        icon: "warning",
                        buttons: {
                            cancel: true,
                            confirm: 'Proceed'
                        },
                        closeOnClickOutside: false
                    })
                    .then((res) => {
                        if (res) {
                            axios.put(`${this.base_url}/admin/trainors/delete/${trainor_id}`)
                            .then(({data}) => {
                                this.getTrainors();
                                swal('Alright!', 'Trainor has been deleted, but you can still bring him/her back.', 'success', {timer:4000,button:false});
                            })
                            .catch((error) => {
                                console.log(error.response);
                            });
                        }
                    });
                },
                undoDeleteTrainor: function(trainor_id) {
                    axios.put(`${this.base_url}/admin/trainors/undo_delete/${trainor_id}`)
                    .then(({data}) => {
                        this.getTrainors();
                        swal('Alright!', 'Trainor has been active again.', 'success', {timer:4000,button:false});
                    })
                    .catch((error) => {
                        console.log(error.response);
                        swal('Ooops!', 'Something went wrong.', 'error', {timer:4000,button:false});
                    });
                },
                confirmDeleteTrainor: function(trainor_id) {
                    swal({
                        title: "Are you sure to delete this Trainor?",
                        text: "This will delete Trainor permanently.",
                        icon: "warning",
                        buttons: {
                            cancel: true,
                            confirm: 'Proceed'
                        },
                        closeOnClickOutside: false
                    })
                    .then((res) => {
                        if (res) { 
                            axios.delete(`${this.base_url}/admin/trainors/permanent_delete/${trainor_id}`)
                            .then(({data}) => {
                                this.getTrainors();
                                swal('Success!', 'Trainor has been permanently deleted.', 'success', {timer:4000,button:false});
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
    </script>
@endpush