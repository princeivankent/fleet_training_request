<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingRequest extends Model
{
    protected $fillable = [
        'company_name',
        'office_address',
        'contact_person',
        'email_address',
        'selling_dealer', // JSON
        'position',
        'contact_number',
        'unit_models', // JSON
        'training_participants', // JSON
        'training_date',
        'training_venue',
        'training_address',
        'training_program_id', // Training Program
        'unit_model_id' // Focus of training
    ];
    protected $primaryKey = 'training_request_id';
    public $timestamps = false;

    public function training_program()
    {
        return $this->belongsTo('App\TrainingProgram', 'training_program_id', 'training_program_id');
    }

    public function unit_model()
    {
        return $this->belongsTo('App\UnitModel', 'unit_model_id', 'unit_model_id');
    }
}
