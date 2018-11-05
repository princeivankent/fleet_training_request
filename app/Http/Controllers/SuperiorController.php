<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Trainor;
use App\ApprovalStatus;
use App\TrainingRequest;
use App\Services\BatchMails;
use App\Http\Requests;

class SuperiorController extends Controller
{
    public function approve($approval_status_id, BatchMails $batch_mails)
    {
        $query = ApprovalStatus::findOrFail($approval_status_id);

        $update = DB::table('approval_statuses')
            ->where('approval_status_id', $query->approval_status_id)
            ->update(['status' => 'approved']);

        if ($update) {
            // Fetch training_request
            $training_request = TrainingRequest::with('training_program')->findOrFail($query->training_request_id);

            $trainors = Trainor::all();
            // To Trainor
            foreach ($trainors as $value) {
                $batch_mails->save_to_batch([
                    'email_category_id' => config('constants.trainor_notification'),
                    'subject' => 'Training Program',
                    'sender' => config('mail.from.address'),
                    'recipient' => $value->email,
                    'title' => 'Training Program',
                    'message' => 'Greetings! IPC Administrator has been approved training request from '. $training_request->contact_person .' of <strong>'. $training_request->company_name .'</strong>.<br/>
                        training program will be held on: '. $training_request->training_program->program_title .' <br/>
                        at '. Carbon::parse($training_request->training_date)->format('Y-m-d h:m a'),
                    'cc' => null,
                    'attachment' => null
                ]);
            }

            // To Requestor
            $batch_mails->save_to_batch([
                'email_category_id' => config('constants.requestor_notification'),
                'subject' => 'Training Program',
                'sender' => config('mail.from.address'),
                'recipient' => $training_request->email,
                'title' => 'Training Program',
                'message' => 'Greetings! IPC Administrator has been approved training request for '. $training_request->training_program->program_title .' to '. $training_request->contact_person .' of <strong>'. $training_request->company_name .'</strong>.<br/>
                    Training program will be held on: '. $training_request->training_address .' <br/>
                    at '. Carbon::parse($training_request->training_date)->format('Y-m-d h:m a'),
                'cc' => null,
                'attachment' => null
            ]);

            echo "<script>window.close();</script>";
        }
        else {
            echo "<script>window.close();</script>";
        }
    }

    public function disapprove($approval_status_id)
    {

    }
}