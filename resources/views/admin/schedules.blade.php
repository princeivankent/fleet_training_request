@extends('layouts.admin_layout')

@push('styles')
	<link rel="stylesheet" href="{{ url('public/libraries/adminlte/bootstrap-datepicker.min.css') }}">
@endpush

@section('content')
<div v-cloak>
	<section class="content-header">
		<h1>Schedules</h1>
	</section>
	
	<section class="content container-fluid">
		<div class="box box-primary shadow-lg">
			<div class="box-header with-border clearfix">
				<h3 class="box-title"><i class="fa fa-thumb-tack"></i>&nbsp; List of Marked Dates</h3>
			</div>
			<div class="box-body">
				<div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Select Date</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="datepicker">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-success btn-flat"
                                    v-on:click="markDate">
                                        <i class="fa fa-plus-circle"></i>
                                    </button>
                                </span>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div v-if="disabled_dates.length > 0" class="card mt-4">
                                        <ul class="list-group list-group-flush">
                                            <li v-for="(item, index) in disabled_dates" 
                                            v-bind:key="index"
                                            class="list-group-item text-center">
                                                <strong>@{{ item.date | dateFormat }}</strong> <span class="text-danger">|</span> Marked by: @{{ item.created_by }}
                                                <button v-on:click="removeDate(item.schedule_id, index)"
                                                class="btn btn-xs btn-danger pull-right">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
			</div>
		</div>
	</section>
</div>
@endsection

@push('scripts')
	<script src="{{ url('public/libraries/adminlte/bootstrap-datepicker.min.js') }}"></script>
	<script>
		new Vue({
			el: '#app',
			data() {
				return {
					disabled_dates: [],
                    selected_date: ''
				}
			},
			created() {
				this.getMarkedDates();
			},
			methods: {
                getMarkedDates: function() {
                    axios.get(`${this.base_url}/admin/schedules/get`)
                    .then(({data}) => {
                        this.disabled_dates = data;
                    })
                    .catch((error) => {
                        console.log(error.response);
                    });
                },
				markDate: function() {
                    var date = document.getElementById('datepicker').value;
                    if (date) {
                        var data = {
                            date: date,
                            reason: '',
                            created_by: 'Prince Ivan Kent' // get this from session
                        }
                        this.disabled_dates.push(data);
                        axios.post(`${this.base_url}/admin/schedules/store`, data)
                        .then(({data}) => {
                            $('#datepicker').val('');
                            console.log(data);
                        })
                        .catch((error) => {
                            console.log(error.response);
                            swal('Ooops!', 'Something went wrong.', 'error', {timer:4000,button:false});
                        });
                    }
                },
                removeDate: function(schedule_id, index) {
                    swal({
                        title: "Delete this marked date?",
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
                            this.disabled_dates.splice(index, 1);
                            axios.delete(`${this.base_url}/admin/schedules/delete/${schedule_id}`)
                            .then(() => {
                                this.getMarkedDates();
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
		document.querySelector('#schedule_tab').setAttribute('class', 'active');
        $(function() {
            $('#datepicker').datepicker({
                autoclose: true
            })
        })
	</script>
@endpush