<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    protected $fillable = ['dealer','branch'];
    protected $primaryKey = 'dealer_id';
    public $timestamps = false;
}
