<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Approver;
use App\ApprovalStatus;
use App\TrainingRequest;
use App\Services\SendEmails;
use App\Http\Requests;

class ApproveRequestController extends Controller
{
    public function update_request(Request $request, $training_request_id, SendEmails $mail) // to administrator
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
                    
                    $mail->send([
                        'email_type' => 'request_for_approval',
                        'subject'	 => 'Request for Training',
                        'to'		 => $value->email,
                        'data'       => [
                            'contact_person' => $requestor->contact_person,
                            'company_name' => $requestor->company_name,
                            'approve_url' => 'http://localhost/laravel5.2/approver/update_request/'. $approval_status->approval_status_id .'/approve'
                        ]
                    ]);
                }
                
                return response()->json($query);
            }
        }

    }

    public function update_approval_request($approval_status_id, $status)
    {
        return response()->json([
            'approval_status_id' => $approval_status_id,
            'status' => $status
        ]);
    }
}
