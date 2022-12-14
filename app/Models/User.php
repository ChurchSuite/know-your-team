<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'job',
        'profile_picture',
    ];

    protected $guarded = [
        'id',
        'organisation_id',
        'password',
        'uuid',
    ];

    public function results()
    {
        return $this->hasMany('App\Models\TestResult');
    }

    public function teams()
    {
        return $this->belongsToMany('App\Models\Team', 'team_members');
    }

}
