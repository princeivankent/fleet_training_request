@extends('layouts.admin_layout') 

@push('styles')
    <link rel="stylesheet" href="{{ url('public/libraries/full-calendar/fullcalendar.min.css') }}">
@endpush

@section('content')
    <div v-cloak>
        <section class="content-header">
            <h1>
                Calendar
            </h1>
            <ol class="breadcrumb">
                <li>
                    <button
                    v-on:click="createSchedule(null)"
                    class="btn btn-flat btn-success pull-right" style="margin-top: -8px; border:none;">
                        <i class="fa fa-plus-circle"></i>&nbsp;
                        CREATE SCHEDULE
                    </button>
                </li>
            </ol>
        </section>

        <section class="content container-fluid">
            <div class="box box-default sub-content shadow-lg">
                <div class="box-body">
                    {{-- {!! $calendar->calendar() !!} --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('admin.modals.scheduler_modal')
@endsection

@push('scripts')
    {{-- {!! $calendar->script() !!} --}}
    <script src="{{ url('public/libraries/full-calendar/fullcalendar.min.js') }}"></script>
    <script>
        $('#calendar_tab').addClass('active');
        var vm = new Vue({
            el: '#app',
            data() {
                return {
                    events: [],
                    form: {
                        start_date: '',
                        end_date: '',
                        reason: null
                    },
                }
            },
            created() {
                this.getEvents();
            },
            methods: {
                getEvents: function() {
                    axios.get(`${this.base_url}/admin/calendar/events`)
                    .then(({data}) => {
                        var events = [];
                        data.forEach(element => {
                            events.push({
                                schedule_id: element.schedule_id,
                                title      : element.reason,
                                start      : element.start_date,
                                end        : element.end_date
                            });
                        });

                        this.events = events;

                        if (this.events.length > 0) {
                            $('#calendar').fullCalendar('destroy');
                            return this.displayEvents();
                        }
                    })
                    .catch((error) => {
                        console.log(error.response);
                    });
                },
                createSchedule: function(date) {
                    this.form = {
                        start_date: date,
                        end_date: '',
                        reason: null
                    }

                    $('#scheduler_modal').modal('show');
                },
                saveSchedule: function() {
                    axios.post(`${this.base_url}/admin/calendar/events/post`, this.form)
                    .then(({data}) => {
                        if (data) {
                            this.form = {};
                            this.getEvents();
                            swal('Success!', 'New Schedule has been created.', 'success', {timer:4000,button:false});
                        }
                    })
                    .catch((error) => {
                        console.log(error.response);
                        swal('Ooops!', 'Something went wrong.', 'error', {timer:4000,button:false});
                    });
                },
                displayEvents: function() {
                    $('#calendar').fullCalendar({
                        navLinks: true,
                        editable: true,
                        header: { 
                            left: 'today, prev,next',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay'
                        },
                        events: this.events,
                        eventClick: function(event) {
                            // console.log(event.end.clone().add(2, 'days'));
                        },
                        dayClick: function(date, jsEvent, view) {
                            vm.createSchedule(date.format()); // pass the date
                        },

                        // Edit
                        eventDrop: function(event, delta, revertFunc) {
                            alert(event.title + " was dropped on " + event.start.format() + ' to ' +  event.end.format());

                            // if (!confirm("Are you sure about this change?")) {
                            //     revertFunc();
                            // }
                        },
                        eventResize: function(event, delta, revertFunc) {
                            alert(event.title + " end is now " + event.end.format());

                            // if (!confirm("is this okay?")) {
                            //     revertFunc();
                            // }
                        }
                    });
                },
            }
        });
    </script>
@endpush