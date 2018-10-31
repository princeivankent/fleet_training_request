<?php

namespace App\Services;

use App\Email;

class BatchMails
{
    public function save_to_batch($params)
    {
        $query = Email::create($params);

        return $query;
    }
}