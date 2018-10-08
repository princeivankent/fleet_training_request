<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingProgram extends Model
{
    protected $fillable = ['program_title','description'];
    protected $primaryKey = 'training_program_id';
    public $timestamps = false;

    public function program_features()
    {
        return $this->hasMany('App\ProgramFeature', 'training_program_id', 'training_program_id');
    }

    public function images()
    {
        return $this->hasMany('App\Image', 'training_program_id', 'training_program_id');
    }
}
