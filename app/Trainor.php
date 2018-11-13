<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainor extends Model
{
    protected $fillable = ['dealer_id','fname','mname','lname','email'];
    protected $primaryKey = 'trainor_id';
    public $timestamps = false;

    public function designated_trainors()
    {
        return $this->hasMany('App\DesignatedTrainor', 'trainor_id', 'trainor_id');
    }
}
