<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Services\SendEmails;
use Carbon\Carbon;
use App\TrainingRequest;
use App\Http\Requests;

class TrainingRequestController extends Controller
{
	public function index()
	{
		return response()->json(
			TrainingRequest::with([
				'training_program',
				'unit_model'
			])
			->get()
		);
	}

	public function show($training_request_id)
	{
		return response()->json(TrainingRequest::findOrFail($training_request_id));
	}

	public function store(Request $request, SendEmails $mail)
	{
		$this->validate($request, [
			'company_name' => 'required|string',
			'office_address' => 'required|string',
			'contact_person' => 'required|string',
			'email' => 'required|string',
			'position' => 'required|string',
			'contact_number' => 'required|string',
			'training_date' => 'required|date',
			'training_venue' => 'required|string',
			'training_address' => 'required|string',
			'training_program_id' => 'required|integer|exists:training_programs,training_program_id',
			'unit_model_id' => 'required|integer|exists:unit_models,unit_model_id'

			// 'selling_dealer' => 'required|json',
			// 'unit_models' => 'required|json',
			// 'training_participants' => 'required|json'
		]);
		
		$input = $request->all();
		$input['training_date'] = Carbon::parse($input['training_date'])->toDateTimeString();
		$input['selling_dealer'] = json_encode($input['selling_dealer']);
		$input['training_participants'] = json_encode($input['training_participants']);
		$input['unit_models'] = json_encode($input['unit_models']);
		
		$query = TrainingRequest::create($input);

		$mail->send([
			'email_type' => 'request_for_acceptance',
			'subject'	 => 'Request for Training',
			'to'		 => $query->email,
			'data'       => [
				'header'  => 'Request for Training',
				'message' => 'Hi Sir/Mam, '.$query->contact_person.' of '.$query->company_name.' is requesting for a training. </br> Please see more details here <a href="http://localhost/laravel5.2/admin/dashboard" class="btn btn-sm btn-success">IPC Fleet Training System</a>'
			]
		]);

		return response()->json($query);
	}
}