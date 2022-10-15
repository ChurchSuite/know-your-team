<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
	use HasFactory;

	public $timestamps = true;

	protected $fillable = [
		'name',
	];

	protected $guarded = [
		'id',
		'organisation_id',
	];

	public function organisation()
    {
        return $this->belongsTo('App\Models\Organisation');
    }

	public function users()
    {
        return $this->belongsToMany('App\Models\User', 'team_members');
    }

}
