<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = ['name'];

    protected $guarded = [
        'id',
        'uuid',
    ];

    public function teams()
    {
        return $this->hasMany('App\Models\Team');
    }

    public function tests()
    {
        return $this->hasMany('App\Models\OrganisationTest', 'organisation_tests');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
