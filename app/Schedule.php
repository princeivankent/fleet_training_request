<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['date','reason','created_by'];
    protected $primaryKey = 'schedule_id';
    public $timestamps = false;
}