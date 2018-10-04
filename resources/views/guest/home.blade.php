@extends('layouts.guest_layout')

@push('styles')
	<link href="{{ url('public/libraries/css/bootstrap.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
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
<template>
	<v-stepper non-linear v-model="e1">
		<v-stepper-header>
			{{-- <v-stepper-step :editable="step1" :complete="e1 > 1" step="1">I. Fleet Customer Information</v-stepper-step> --}}
			<v-stepper-step editable :complete="e1 > 1" step="1">I. Customer Information</v-stepper-step>
			<v-divider></v-divider>
			{{-- <v-stepper-step :editable="step2" :complete="e1 > 2" step="2">II. Training Information</v-stepper-step> --}}
			<v-stepper-step editable :complete="e1 > 2" step="2">II. Training Information</v-stepper-step>
			<v-divider></v-divider>
			{{-- <v-stepper-step :editable="step3" :complete="e1 > 3" step="3">Training Program Offerings</v-stepper-step> --}}
			<v-stepper-step editable :complete="e1 > 3" step="3">Program Offerings</v-stepper-step>
			<v-divider></v-divider>

			<v-stepper-step editable :complete="e1 > 4" step="4">Isuzu Models</v-stepper-step>
			<v-divider></v-divider>
			{{-- <v-stepper-step :editable="step4" step="4">Submit</v-stepper-step> --}}
			<v-stepper-step editable step="5">Submit</v-stepper-step>
		</v-stepper-header>
	
		<v-stepper-items>
			<v-stepper-content step="1">
				@include('guest.customer_information')

				<pre>@{{ form }}</pre>
		
				<v-btn
				color="primary"
				v-on:click="step(2)"
				>
				Continue
				</v-btn>
		
			</v-stepper-content>
		
			<v-stepper-content step="2">
				@include('guest.training_information')
				
				<v-btn
				color="primary"
				v-on:click="step(3)"
				>
				Continue
				</v-btn>
		
			</v-stepper-content>
		
			<v-stepper-content step="3">
				@include('guest.programs_offering')
			</v-stepper-content>

			<v-stepper-content step="4">
				@include('guest.isuzu_models')
		
			</v-stepper-content>

			<v-stepper-content step="5">
				@include('guest.submit_form')
		
				<v-btn
				color="primary"
				v-on:click="step(1)"
				>
				Submit
				</v-btn>
		
			</v-stepper-content>
		</v-stepper-items>
	</v-stepper>
</template>
@endsection

@push('scripts')
	<script src="{{ url('public/libraries/js/bootstrap.min.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
	
	<script>
		new Vue({
			el: '#app',
			data() {
				return {
					e1: 0,
					dialog: false,
					photo_gallery: false,
					drawer: true,
					participants: {},
					//
					step1: true,
					step2: false,
					step3: false,
					step4: false,
					// Form
					form: {
						company_name: '',
						office_address: '',
						contact_person: '',
						email: '',
						contact_number: '',
						selling_dealer: [],
						position: '',
						contact_number: '',
						unit_models: [],
						
						training_date: '',
						training_participants: [],
						training_venue: [],
						training_address: ''
					}
				}
			},
			props: {
				source: String
			},
			created() {
				this.e1 = 2;
			},
			methods: {
				submit_form() {
					
				},

				step(step) {
					this.e1 = step;
					if (step === 2) {
						this.step1 = true;
						this.step2 = true;
					}
					else if (step === 3) {
						this.step1 = true;
						this.step2 = true;
						this.step3 = true;
					}
					else if (step === 4) {
						this.step1 = true;
						this.step2 = true;
						this.step3 = true;
						this.step4 = true;
					}
					else if (step === 5) {
						this.step1 = true;
						this.step2 = true;
						this.step3 = true;
						this.step4 = true;
						this.step5 = true;
					}
				},
				remove(index) {
					this.training_participants.splice(index, 1);
				},
				add() {
					if (this.participants.participant != null && this.participants.quantity != null) {
						this.form.training_participants.push(this.participants);
						this.participants = {};
						this.dialog = false;
					}
				},
				others() {
					this.dialog = true;
				}
			}
		})
		
		$(document).ready(function() {
			$('.selectpicker').selectpicker();
		});
	</script>
@endpush