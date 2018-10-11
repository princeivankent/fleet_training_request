<?php

namespace App\Services;

use Mail;

class SendEmails
{
    public function send($params)
    {
        return Mail::send('emails.' . $params['email_type'], ['data' => $params['data']], function ($mail) use ($params) {
            $mail->from('interface-notif@isuzuphil.com', 'System Notfication'); // Default
            $mail->to($params['to'])->subject($params['subject']);
        });
    }
}