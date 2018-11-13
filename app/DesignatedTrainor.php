<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesignatedTrainor extends Model
{
    protected $fillable = ['training_request_id','trainor_id','assigned_by'];
    protected $primaryKey = 'trainor_designation_id';
    public $timestamps = false;

    public function training_request()
    {
        return $this->belongsTo('App\TrainingRequest', 'training_request_id', 'training_request_id');
    }

    public function trainor()
    {
        return $this->belongsTo('App\Trainor', 'trainor_id', 'trainor_id');
    }
}
