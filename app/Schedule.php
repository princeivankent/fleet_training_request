<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'start_date',
        'end_date',
        'reason',
        'training_request_id',
        'created_by'
    ];
    protected $primaryKey = 'schedule_id';
    public $timestamps = false;

    public function training_request()
    {
        return $this->belongsTo('App\TrainingRequest', 'training_request_id', 'training_request_id');
    }
}