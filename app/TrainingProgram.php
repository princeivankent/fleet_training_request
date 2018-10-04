<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingProgram extends Model
{
    protected $fillable = ['program_title','description','details'];
    protected $primaryKey = 'training_program_title';
    public $timestamps = false;

    public function images()
    {
        return $this->hasMany('App\Image', 'training_program_id', 'training_program_id');
    }
}
