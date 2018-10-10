<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Approver extends Model
{
	protected $fillable = ['approver_name','status'];
	protected $primaryKey = 'approver_id';
	public $timestamps = false;

	public function approval_statuses()
	{
		return $this->hasMany('App\ApprovalStatus', 'approver_id', 'approver_id');
	}
}
