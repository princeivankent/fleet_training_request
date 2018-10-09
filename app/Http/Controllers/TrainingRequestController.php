<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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

	public function store(Request $request)
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

		return response()->json($query);

	}
}