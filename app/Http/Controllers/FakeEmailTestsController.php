<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Services\SendEmails;

class FakeEmailTestsController extends Controller
{
    public function send(SendEmails $mail)
    {
        $mail->send([
			'email_type' => 'request_for_acceptance',
			'subject'	 => 'Request for Training',
			'to'		 => 'prince-tiburcio@isuzuphil.com',
			'data'       => [
                'contact_person' => 'Maria Ivy T. Raymundo',
                'company_name' => 'Fourmi Structured Cabling Services',
            ]
        ]);
        
        return response()->json($mail);
    }
}