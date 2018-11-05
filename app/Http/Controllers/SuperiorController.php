<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ApprovalStatus;
use App\Http\Requests;

class SuperiorController extends Controller
{
    public function approve($approval_status_id)
    {
        $query = ApprovalStatus::findOrFail($approval_status_id);
        $query->status = 'approved';
        $query->save();

        
    }
}