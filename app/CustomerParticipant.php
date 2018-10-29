<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerParticipant extends Model
{
    protected $fillable = ['training_request_id','participant','quantity'];
    protected $primaryKey = 'customer_participant_id';
    public $timestamps = false;

    public function training_request()
    {
        return $this->belongsTo('App\TrainingRequest', 'training_request_id', 'training_request_id');
    }
}
