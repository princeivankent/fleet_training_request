<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Trainor;
use App\UserAccess;
use App\ApprovalStatus;
use App\TrainingRequest;
use App\Services\BatchMails;
use App\Services\SendEmail;
use App\TrainingProgram;
use Carbon\Carbon;
use App\Http\Requests;

class TrainingRequestController extends Controller
{	
	public function training_requests_statuses()
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
				'unit_model',
				'trainor_designations.trainor',
				'dealer_details'
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
				'unit_model',
				'dealer_details'
			])
			->first();

		return response()->json($query);
	}

	public function store(Request $request, SendEmail $mail, BatchMails $batch_mails)
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
					'dealer'              => $dealer->dealer,
					'branch'              => $dealer->branch
				]);
			}

			// Customer Participants
			foreach ($input['training_participants'] as $value) {
				DB::table('customer_participants')->insert([
					'training_request_id' => $training_request_id,
					'participant'         => $value['participant'],
					'quantity'            => $value['quantity']
				]);
			}

			// Unit Models
			foreach ($input['unit_models'] as $model) {
				DB::table('customer_models')->insert([
					'training_request_id' => $training_request_id,
					'model'               => $model
				]);
			}

			DB::commit();

			$training_program = TrainingProgram::findOrFail($query->training_program_id);
			if ($query) {
				$user_access = UserAccess::select('et.email')
					->leftJoin('email_tab as et', 'et.employee_id', '=', 'user_access_tab.employee_id')
					->where([
						'system_id'    => config('app.system_id'),
						'user_type_id' => 2
					])
					->get();

				// To Administrator
				foreach ($user_access as $value) {
					$batch_mails->save_to_batch([
						'email_category_id' => config('constants.admin_approval'),
						'subject'           => 'Requesting for a Training',
						'sender'            => config('mail.from.address'),
						'recipient'         => $value['email'],
						'title'             => 'Training Request',
						'message'           => 'Greetings! '. $query->contact_person .' of <strong>'. $query->company_name .'</strong> is requesting for a <br/>
							training program: '. $training_program->program_title .' <br/>
							on '. Carbon::parse($query->training_date)->format('M d, Y D - h:i A') .'
							Please click the button to navigate directly to our system.',
						'redirect_url' => 'http://localhost/fleet_training_request/admin/training_requests',
						'cc'           => null,
						'attachment'   => null
					]);
				}

				// To Requestor
				$batch_mails->save_to_batch([
					'email_category_id' => config('constants.default_notification'),
					'subject'           => 'Request Submitted',
					'sender'            => config('mail.from.address'),
					'recipient'         => $query->email,
					'title'             => 'Request Submitted!',
					'message'           => 'Greetings! Your <strong>request for training has been submitted.</strong> Please wait for IPC Administrator to response.<br>
						Thank you.',
					'redirect_url' => null,
					'cc'           => null,
					'attachment'   => null
				]);
				return $query;
			}
		} catch (Exception $e) {
			report($e);
			DB::rollBack();

			return false;
		}
	}
}