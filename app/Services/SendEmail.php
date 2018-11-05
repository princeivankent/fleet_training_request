<?php

namespace App\Services;

use App\Mail\ModuleCreated;
use Illuminate\Support\Facades\Mail;

class SendEmail
{
    public function send($params)
    {
        $data = [
            'email_category_id' => $params['email_category_id'],
            'subject'	     => $params['subject'],
            'sender'	     => $params['sender'],
            'recipient'	     => $params['recipient'],
            'cc'	         => $params['cc'],
            'attachment'	 => $params['attachment'],
            'redirect_url'	 => $params['redirect_url'],
            'content'	     => $params['content']
        ];

        if ($data['email_category_id'] == '2') $template = 'superior_email_template';
        else $template = 'default_email';

        return Mail::send('emails.' . $template, ['content' => $data['content']], function ($mail) use ($data) {
            $mail->from($data['sender'], 'Fleet Training Request System');
            $mail->to($data['recipient'])->subject($data['subject']);
            
            if (isset($data['cc'])) $mail->cc($data['cc']);
            if (isset($data['attachment'])) $mail->attach($data['attachment']);
        });
    }
}