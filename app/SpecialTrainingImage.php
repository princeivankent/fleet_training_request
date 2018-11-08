<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialTrainingImage extends Model
{
    protected $fillable = ['special_training_id','image'];
    protected $primaryKey = 'special_training_image_id';
    public $timestamps = false;

    public function special_training()
    {
        return $this->belongsTo('App\SpecialTraining', 'special_training_id', 'special_training_id');
    }
}
