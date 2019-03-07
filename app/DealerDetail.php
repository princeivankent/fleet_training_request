<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealerDetail extends Model
{
    protected $fillable = [
        'requestor_name', 
        'dealership_name',
        'position',
        'email',
        'contact',
        'training_request_id'
    ];

    public function training_request()
    {
        return $this->belongsTo(TrainingRequest::class);
    }
}
