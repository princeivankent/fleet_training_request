<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use App\Trainor;
use App\UserAccess;
use App\TrainingRequest;
use App\Services\BatchMails;
use App\Http\Requests;

class RequestorController extends Controller
{
	public function confirm($training_request_id, BatchMails $batch_mails)
	{
		$check = TrainingRequest::findOrFail($training_request_id);

		if ($check->requestor_confirmation == 'pending') {
			$query = DB::table('training_requests')
				->where('training_request_id', $training_request_id)
				->update([
					'requestor_confirmation' => 'confirmed'
				]);
	
			if ($query) {
				$trainors = Trainor::with(['designated_trainors' => function($query) use($training_request_id) {
						$query->where('training_request_id', $training_request_id);
					}])
					->leftJoin('designated_trainors as dt', 'dt.trainor_id', '=', 'trainors.trainor_id')
					->where([
						['deleted_at', '=', NULL],
						['dt.designated_trainor_id', '!=', NULL]
					])
					->get();
					
				foreach ($trainors as $value) {
					$batch_mails->save_to_batch([
						'email_category_id' => config('constants.trainor_notification'),
						'subject'           => 'Training Program',
						'sender'            => config('mail.from.address'),
						'recipient'         => $value->email,
						'title'             => 'Training Program',
						'message'           => 'There will be a Training Program: <strong>'. $check->training_program->program_title .'</strong>.<br/>
							that will be held on: '. Carbon::parse($check->training_date)->format('M d, Y D - h:i A').'<br/>
							at: '. $check->training_address,
						'cc'         => null,
						'attachment' => null
					]);
				}

				$user_access = UserAccess::select('et.email')
                    ->leftJoin('email_tab as et', 'et.employee_id', '=', 'user_access_tab.employee_id')
                    ->where([
                        'system_id'    => config('app.system_id'),
                        'user_type_id' => 2
                    ])
                    ->get();
    
                foreach ($user_access as $value) {
                    $query = $batch_mails->save_to_batch([
                        'email_category_id' => null,
                        'subject'           => 'Training Program',
                        'sender'            => config('mail.from.address'),
                        'recipient'         => $value->email,
                        'title'             => 'Training Program',
                        'message'           => $check->contact_person . ' of <strong>'. $check->company_name .'</strong><br/>
                            has been confirmed the training program.',
                        'cc'           => null,
                        'attachment'   => null,
                        'redirect_url' => 'http://localhost/fleet_training_request/admin/training_requests'
                    ]);
                }

				$content = [
					'type'    => 'success',
					'message' => 'Your request has been confirmed. We will see you on Training Program. Thank you!'
				];
				return response()->view('public_pages.message', compact('content'));
			}
			else {
				$content = [
					'type'    => 'info',
					'message' => 'This request has been already confirmed.'
				];
				return response()->view('public_pages.message', compact('content'));
			}
		}
		else {
			$content = [
				'type'    => 'info',
				'message' => 'Sorry! It seems you\'ve been already made an action here.'
			];
			return response()->view('public_pages.message', compact('content'));
		}
	}

	public function cancel($training_request_id, BatchMails $batch_mails)
	{
		$check = TrainingRequest::findOrFail($training_request_id);

		if ($check->requestor_confirmation == 'pending') {
			$query = DB::table('training_requests')
				->where('training_request_id', $training_request_id)
				->update([
					'requestor_confirmation' => 'cancelled'
				]);
	
			if ($query) {
				$user_access = UserAccess::select('et.email')
                    ->leftJoin('email_tab as et', 'et.employee_id', '=', 'user_access_tab.employee_id')
                    ->where([
                        'system_id'    => config('app.system_id'),
                        'user_type_id' => 2
                    ])
                    ->get();
    
                foreach ($user_access as $value) {
                    $query = $batch_mails->save_to_batch([
                        'email_category_id' => null,
                        'subject'           => 'Training Program',
                        'sender'            => config('mail.from.address'),
                        'recipient'         => $value->email,
                        'title'             => 'Training Program',
                        'message'           => $check->contact_person . ' of <strong>'. $check->company_name .'</strong><br/>
                            has been cancelled the training program.',
                        'cc'           => null,
                        'attachment'   => null,
                        'redirect_url' => 'http://localhost/fleet_training_request/admin/training_requests'
                    ]);
                }

				$content = [
					'type'    => 'success',
					'message' => 'Your request has been cancelled.'
				];
				return response()->view('public_pages.message', compact('content'));
			}
			else {
				$content = [
					'type'    => 'info',
					'message' => 'Ooops! Your request has been already cancelled.'
				];
				return response()->view('public_pages.message', compact('content'));
			}
		}
		else {
			$content = [
				'type'    => 'info',
				'message' => 'Sorry! It seems you\'ve been already made an action here.'
			];
			return response()->view('public_pages.message', compact('content'));
		}
	}
	
	public function reschedule($training_request_id, BatchMails $batch_mails)
	{
		$check = TrainingRequest::findOrFail($training_request_id);

		if ($check->requestor_confirmation == 'pending') {
			$query = DB::table('training_requests')
				->where('training_request_id', $training_request_id)
				->update([
					'requestor_confirmation' => 'reschedule'
				]);

			if ($query) {
				$user_access = UserAccess::select('et.email')
					->leftJoin('email_tab as et', 'et.employee_id', '=', 'user_access_tab.employee_id')
					->where([
						'system_id'    => config('app.system_id'),
						'user_type_id' => 2
					])
					->get();

				foreach ($user_access as $value) {
					$query = $batch_mails->save_to_batch([
						'email_category_id' => null,
						'subject'           => 'Reschedule Training Program',
						'sender'            => config('mail.from.address'),
						'recipient'         => $value->email,
						'title'             => 'Reschedule Training Program',
						'message'           => $check->contact_person . ' of <strong>'. $check->company_name .'</strong><br/>
							has been requesting for a reschedule of their training program. <br/>
							You may call him/her on this number: <strong>'.$check->contact_number.'</strong>',
						'cc'           => null,
						'attachment'   => null,
						'redirect_url' => 'http://localhost/fleet_training_request/admin/training_requests'
					]);
				}

				$content = [
					'type'    => 'success',
					'message' => 'Your request for a reschedule training program has been sent! Please wait for our response. Thank you.'
				];
				return response()->view('public_pages.message', compact('content'));
			}
			else {
				$content = [
					'type'    => 'info',
					'message' => 'Sorry! It seems you\'ve been already made an action here.'
				];
				return response()->view('public_pages.message', compact('content'));
			}
		}
		else {
			$content = [
				'type'    => 'info',
				'message' => 'Sorry! It seems you\'ve been already made an action here.'
			];
			return response()->view('public_pages.message', compact('content'));
		}
	}
}