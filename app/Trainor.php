<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainor extends Model
{
    protected $fillable = ['dealer_id','fname','mname','lname','email'];
    protected $primaryKey = 'trainor_id';
    public $timestamps = false;

    public function dealer()
    {
        return $this->belongsTo('App\Dealer', 'dealer_id', 'dealer_id');
    }
}
