<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\TrainingProgram;
use App\Approver;
use App\ApprovalStatus;
use App\TrainingRequest;
use App\Services\SendEmail;
use App\Services\BatchMails;
use App\Http\Requests;

class ApproveRequestController extends Controller
{
    public function update_request(Request $request, $training_request_id, SendEmail $mail, BatchMails $batch_mails) // to administrator
    {
        $training_request = DB::table('training_requests')->where('training_request_id', $training_request_id)->first();

        if ($training_request) {
            $query = DB::table('training_requests')->where('training_request_id', $training_request->training_request_id)
                ->update([
                    'request_status' => $request->request_status
                ]);

            // If $query == 1 email sent
            if ($query) {
                $approvers = Approver::all();
    
                foreach ($approvers as $value) {
                    $approval_status = new ApprovalStatus;
                    $approval_status->training_request_id = $training_request->training_request_id;
                    $approval_status->approver_id = $value['approver_id'];
                    $approval_status->save();

                    $approver_id = $approval_status->approver_id;
                    $approver = Approver::findOrFail($approver_id);
                    $training_program = TrainingProgram::findOrFail($training_request->training_program_id);

                    $batch_mails->save_to_batch([
                        'email_category_id' => config('constants.superior_approval'),
                        'subject' => 'Training Request Approval',
                        'sender' => config('mail.from.address'),
                        'recipient' => $approver->email,
                        'title' => 'Training Request Approval',
                        'message' => 'Greetings! '. $training_request->contact_person .' of <strong>'. $training_request->company_name .'</strong> is requesting for a <br/>
						training program: '. $training_program->program_title .' <br/>
						on '. Carbon::parse($training_request->training_date)->format('M d, Y D - h:i A'),
						'cc' => null,
                        'attachment' => null,
                        'accept_url' => route('superior_approval', ['approval_status_id' => $approval_status->approval_status_id]),
                        'deny_url' => route('superior_disapproval', ['approval_status_id' => $approval_status->approval_status_id])
                    ]);
                }
                return response()->json($query);
            }
        }

    }

    public function update_approval_request($approval_status_id, $status)
    {
        $query = ApprovalStatus::findOrFail($approval_status_id);
        $query->status = 'approved';
        $query->save();

        return response()->json($query);
    }
}
