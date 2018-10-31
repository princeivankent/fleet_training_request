<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Approver;
use App\ApprovalStatus;
use App\TrainingRequest;
use App\Services\SendEmails;
use App\Services\BatchMails;
use App\Http\Requests;

class ApproveRequestController extends Controller
{
    public function update_request(Request $request, $training_request_id, SendEmails $mail, BatchMails $batch_mails) // to administrator
    {
        $requestor = DB::table('training_requests')->where('training_request_id', $training_request_id)->first();

        if ($requestor) {
            $query = DB::table('training_requests')->where('training_request_id', $requestor->training_request_id)
                ->update([
                    'request_status' => $request->request_status
                ]);

            // If $query == 1 email sent
            if ($query) {
                $approvers = Approver::all();
    
                foreach ($approvers as $value) {
                    $approval_status = new ApprovalStatus;
                    $approval_status->training_request_id = $requestor->training_request_id;
                    $approval_status->approver_id = $value['approver_id'];
                    $approval_status->save();

                    $batch_mails->save_to_batch([
                        'email_category_id' => config('constants.superior_approval'),
                        'subject' => 'Training Request Approval',
                        'sender' => config('mail.from.address'),
                        'recipient' => $approval_status->email,
                        'title' => 'Training Request Approval',
                        'message' => 'Greetings! Your <strong>request for training has been submitted.</strong> has been created a new schedule for a examination. <br>
						Please click the button to navigate directly to your system.',
						'cc' => null,
						'attachment' => null
                    ]);
                    
                    // $mail->send([
                    //     'email_type' => 'request_for_approval',
                    //     'subject'	 => 'Request for Training',
                    //     'to'		 => $value->email,
                    //     'data'       => [
                    //         'contact_person' => $requestor->contact_person,
                    //         'company_name' => $requestor->company_name,
                    //         'approve_url' => 'http://localhost/fleet_training_request/approver/update_request/'. $approval_status->approval_status_id .'/approve'
                    //     ]
                    // ]);
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
