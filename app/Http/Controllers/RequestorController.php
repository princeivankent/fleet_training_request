<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TrainingRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class RequestorController extends Controller
{
    public function confirm($training_request_id)
    {
        $check = TrainingRequest::findOrFail($training_request_id);

        if ($check->requestor_confirmation == 'pending') {
            $query = DB::table('training_requests')
                ->where('training_request_id', $training_request_id)
                ->update([
                    'requestor_confirmation' => 'confirmed'
                ]);
    
            if ($query) {
                $content = [
                    'type' => 'success',
                    'message' => 'Your request has been confirmed. We will see you on Training Program. Thank you!'
                ];
                return response()->view('public_pages.message', compact('content'));
            }
            else {
                $content = [
                    'type' => 'info',
                    'message' => 'Ooops! Your request has been already confirmed.'
                ];
                return response()->view('public_pages.message', compact('content'));
            }
        }
        else {
            $content = [
                'type' => 'info',
                'message' => 'Sorry! It seems you\'ve been already made an action here.'
            ];
            return response()->view('public_pages.message', compact('content'));
        }
    }

    public function cancel($training_request_id)
    {
        $check = TrainingRequest::findOrFail($training_request_id);

        if ($check->requestor_confirmation == 'pending') {
            $query = DB::table('training_requests')
                ->where('training_request_id', $training_request_id)
                ->update([
                    'requestor_confirmation' => 'cancelled'
                ]);
    
            if ($query) {
                $content = [
                    'type' => 'success',
                    'message' => 'Your request has been cancelled.'
                ];
                return response()->view('public_pages.message', compact('content'));
            }
            else {
                $content = [
                    'type' => 'info',
                    'message' => 'Ooops! Your request has been already cancelled.'
                ];
                return response()->view('public_pages.message', compact('content'));
            }
        }
        else {
            $content = [
                'type' => 'info',
                'message' => 'Sorry! It seems you\'ve been already made an action here.'
            ];
            return response()->view('public_pages.message', compact('content'));
        }
    }
    
    public function resched($training_request_id)
    {

    }
}