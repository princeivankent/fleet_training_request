<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SessionLoginController extends Controller
{
    public function login($employee_id, $employee_no, $full_name, $section)
    {
        $credentials = [
            'employee_id' => base64_decode(urldecode($employee_id)),
            'employee_no' => base64_decode(urldecode($employee_no)),
            'full_name' => base64_decode(urldecode($full_name)),
            'section' => base64_decode(urldecode($section))
        ];

        session($credentials);

        if (Session()->has(
            [
                'section', 
                'full_name', 
                'employee_no', 
                'employee_id'
            ]
        )) {
            Session()->regenerate();
            return redirect()->route('training_requests');
        }
        else {
            return response()->json('Sorry, you are not allowed to access this application.');
        }
    }
}
