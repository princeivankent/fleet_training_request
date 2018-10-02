@extends('layouts.guest_layout')

@push('styles')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
	<link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet">
@endpush

@section('content')
	<div class="row">
		<div class="col-md-12">
			<v-app>
				<v-content>
					<template>
						<v-stepper v-model="e6" vertical non-linear>
							<v-stepper-step editable :complete="e6 > 1" editable step="1">
								<h4>
									Select an app
								</h4>
								Summarize if needed
							</v-stepper-step>
					
							<v-stepper-content step="1">
								@include('guest.customer_information')
								<v-btn color="primary" @click="e6 = 2">Continue</v-btn>
								<v-btn flat>Cancel</v-btn>
							</v-stepper-content>
					
							<v-stepper-step :complete="e6 > 2" editable step="2">Configure analytics for this app</v-stepper-step>
					
							<v-stepper-content step="2">
								@include('guest.training_information')
								<v-btn color="primary" @click="e6 = 3">Continue</v-btn>
								<v-btn flat>Cancel</v-btn>
							</v-stepper-content>
					
							<v-stepper-step :complete="e6 > 3" editable step="3">Select an ad format and name ad unit</v-stepper-step>
					
							<v-stepper-content step="3">
								@include('guest.training_information')
								<v-btn color="primary" @click="e6 = 4">Continue</v-btn>
								<v-btn flat>Cancel</v-btn>
							</v-stepper-content>
						
							<v-stepper-step editable step="4">View setup instructions</v-stepper-step>
							<v-stepper-content step="4">
								@include('guest.training_information')
								<v-btn color="primary" @click="e6 = 1">Continue</v-btn>
								<v-btn flat>Cancel</v-btn>
							</v-stepper-content>
						</v-stepper>
					</template>
				</v-content>
			</v-app>
		</div>
	</div>
@endsection

@push('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.js"></script>
	<script>
		new Vue({
			el: '#app',
			data() {
				return {
					training_participants: [
						{
							participants: 'Mechanic',
							quantity: 5
						},
						{
							participants: 'Driver',
							quantity: 5
						},
					],
					e6: 1
				}
			},
			created() {
				
			},
			methods: {
				
			}
		})
		
		$(document).ready(function() {
			$('.selectpicker').selectpicker();
		});
	</script>
@endpush