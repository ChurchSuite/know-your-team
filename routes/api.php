<?php

use App\Models\Organisation;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// POST /api/organisation
Route::post('/organisation', function(Request $request) {
    $request->validate([
        'name' => 'required|string|max:50',
    ]);

	$organisation = new Organisation([
		'name' => $request->name,
	]);

    // fill guarded fields
	$organisation->uuid = Str::uuid();

    // save to the database
	$organisation->save();
});

// POST /api/team
Route::post('/team', function(Request $request) {
    $request->validate([
        'name' => 'required|string|max:50',
        'organisation_uuid' => 'required|uuid',
    ]);

	$team = new Team([
		'name' => $request->name,
	]);

    // get the organisation id from the UUID
    $organisation = Organisation::where('uuid', $request->organisation_uuid)->get();

    // fill guarded fields
	$team->organisation_id = $organisation->id;

    // save to the database
	$team->save();
});

// POST /api/user
Route::post('/user', function(Request $request) {
    $request->validate([
        'first_name' => 'required|string|max:50',
        'last_name' => 'required|string|max:50',
        'email' => 'required|email',
        'job' => 'required|string|max:50',
        'organisation_uuid' => 'required|uuid',
    ]);

	$user = new User([
		'first_name' => $request->first_name,
		'last_name' => $request->last_name,
		'email' => $request->email,
		'job' => $request->job,
	]);

    // get the organisation id from the UUID
    $organisation = Organisation::where('uuid', $request->organisation_uuid)->get();

    // fill guarded fields
	$user->organisation_id = $organisation->id;
	$user->password = 'password';
	$user->uuid = Str::uuid();

    // save to the database
	$user->save();
});