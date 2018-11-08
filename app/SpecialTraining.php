<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialTraining extends Model
{
    protected $fillable = ['program_title'];
    protected $primaryKey = 'special_training_id';
    public $timestamps = false;

    public function special_training_images()
    {
        return $this->hasMany('App\SpecialTrainingImage', 'special_training_id', 'special_training_id');
    }
}