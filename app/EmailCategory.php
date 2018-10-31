<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailCategory extends Model
{
    protected $fillable = ['category'];
    protected $primaryKey = 'email_category_id';
    public $timestamps = false;
}
