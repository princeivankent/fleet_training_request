<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    protected $fillable = ['training_request_id','model'];
    protected $primaryKey = 'customer_model_id';
    public $timestamps = false;

    public function training_request()
    {
        return $this->belongsTo('App\TrainingRequest', 'training_request_id', 'training_request_id');
    }
}
