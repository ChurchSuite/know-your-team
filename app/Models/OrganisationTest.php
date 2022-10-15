<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganisationTest extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = ['test_identifier'];

    protected $guarded = [
        'organisation_id',
    ];
}
