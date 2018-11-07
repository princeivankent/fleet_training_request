<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\BatchMails;
use App\TrainingRequest;
use Carbon\Carbon;
use App\Http\Requests;

class RescheduleController extends Controller
{
    public function reschedule(Request $request, $training_request_id, BatchMails $batch_mails)
    {
        $query = TrainingRequest::findOrFail($training_request_id);
        $query->training_date = $request->training_date;
        $query->requestor_confirmation = 'confirmed';
        $query->save();

        if ($query) {
            $query = $batch_mails->save_to_batch([
                'email_category_id' => config('constants.default_notification'),
                'subject'           => 'Rescheduled Training Program',
                'sender'            => config('mail.from.address'),
                'recipient'         => $query->email,
                'title'             => 'Rescheduled Training Program',
                'message'           => 'Your Training Request has been successfully rescheduled. <br/>
                    See you on '. $query->training_address .' <br/>
                    at '. Carbon::parse($query->training_date)->format('M d, Y D - h:i A') . '. Thank you!',
                'cc'           => null,
                'attachment'   => null,
                'redirect_url' => 'http://localhost/fleet_training_request/admin/training_requests'
            ]);

            return response()->json($query);
        }
    }
}