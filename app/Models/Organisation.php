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

    public function tests()
    {
        return $this->belongsToMany('App\Models\OrganisationTest', 'organisation_tests');
    }
}
