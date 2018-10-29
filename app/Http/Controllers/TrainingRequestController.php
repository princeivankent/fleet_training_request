<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\ApprovalStatus;
use App\TrainingRequest;
use Carbon\Carbon;
use App\Services\SendEmails;
use App\Http\Requests;

class TrainingRequestController extends Controller
{	
	public function dashboard_statuses()
	{
		return response()->json([
			'all_requests' => TrainingRequest::count(),
			'pending_requests' => TrainingRequest::where('request_status', 'pending')->count(),
			'approved_requests' => TrainingRequest::where('request_status', 'approved')->count(),
			'denied_requests' => TrainingRequest::where('request_status', 'denied')->count()
		]);
	}

	public function approver_statuses($training_request_id)
	{
		$query = ApprovalStatus::where('training_request_id', $training_request_id)
			->with('approver')
			->get();
		
		return response()->json($query);
	}

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
		$query = TrainingRequest::where('training_request_id', $training_request_id)
			->with([
				'customer_dealers',
				'customer_models',
				'customer_participants',
				'training_program',
				'unit_model'
			])
			->first();

		return response()->json($query);
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
			'unit_model_id' => 'required|integer|exists:unit_models,unit_model_id',
		]);
		
		try {
			DB::beginTransaction();

			$input = $request->all();

			$input['training_date'] = Carbon::parse($input['training_date'])->toDateTimeString();
			$query = TrainingRequest::create($input);
			$training_request_id = $query->training_request_id;

			// Save Dealers
			foreach ($input['selling_dealer'] as $dealer_id) {
				$dealer = DB::table('dealers')->where('dealer_id', $dealer_id)->first();
				DB::table('customer_dealers')->insert([
					'training_request_id' => $training_request_id,
					'dealer' => $dealer->dealer,
					'branch' => $dealer->branch
				]);
			}

			// Customer Participants
			foreach ($input['training_participants'] as $value) {
				DB::table('customer_participants')->insert([
					'training_request_id' => $training_request_id,
					'participant' => $value['participant'],
					'quantity' => $value['quantity']
				]);
			}

			// Unit Models
			foreach ($input['unit_models'] as $model) {
				DB::table('customer_models')->insert([
					'training_request_id' => $training_request_id,
					'model' => $model
				]);
			}

			DB::commit();

			if ($query) {
				$mail->send([
					'email_type' => 'request_for_acceptance',
					'subject'	 => 'Request for Training',
					'to'		 => $query->email,
					'data'       => [
						'contact_person' => $query->contact_person,
						'company_name' => $query->company_name,
					]
				]);
			}

			return 200;
		} catch (Exception $e) {
			report($e);
			DB::rollBack();

			return false;
		}
	}
}