<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerDealer extends Model
{
    protected $fillable = ['training_request_id','dealer','branch'];
    protected $primaryKey = 'customer_dealer_id';
    public $timestamps = false;

    public function training_request()
    {
        return $this->belongsTo('App\TrainingRequest', 'training_request_id', 'training_request_id');
    }
}
