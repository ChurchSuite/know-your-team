<?php

use App\Models\Organisation;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
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
        'first_name' => 'required|string|max:50',
        'last_name' => 'required|string|max:50',
        'email' => 'required|email',
        'job' => 'required|string|max:50',
        'profile_picture' => 'url',
    ]);

	$organisation = new Organisation([
		'name' => $request->name,
	]);

    // fill guarded fields
	$organisation->uuid = Str::uuid();

    // save to the database
	$organisation->save();

    // now create the user
    $user = new User([
		'first_name' => $request->first_name,
		'last_name' => $request->last_name,
		'email' => $request->email,
		'job' => $request->job,
		'profile_picture' => $request->profile_picture ?? '',
	]);

    // fill guarded fields
	$user->organisation_id = $organisation->id;
	$user->password = 'password';
	$user->uuid = Str::uuid();

    // save to the database
	$user->save();

    return redirect('/organisation/'.$organisation->uuid);
});

// PUT /api/organisation/:uuid
Route::put('/organisation/{organisation:uuid}', function(Request $request, Organisation $organisation) {
    $request->validate([
        'name' => 'required|string|max:50',
    ]);
error_log(print_r($request->name, true));
	$organisation->name = $request->name;

    // save to the database
	$organisation->save();
});

// POST /api/team
Route::post('/team', function(Request $request) {
    $request->validate([
        'name' => 'required|string|max:50',
    ]);

	$team = new Team([
		'name' => $request->name,
	]);

    // fill guarded fields
	$team->organisation_id = Session::get('organisation_id');

    // save to the database
	$team->save();
});

// POST /api/test_result
Route::post('/test_result', function(Request $request) {
    $request->validate([
        'test_identifier' => 'required|string|max:50',
        'result' => 'required',
        'user_uuid' => 'required|uuid',
    ]);
});

// POST /api/user
Route::post('/user', function(Request $request) {
    $request->validate([
        'first_name' => 'required|string|max:50',
        'last_name' => 'required|string|max:50',
        'email' => 'required|email',
        'job' => 'required|string|max:50',
        'profile_picture' => 'required|url',
    ]);

	$user = new User([
		'first_name' => $request->first_name,
		'last_name' => $request->last_name,
		'email' => $request->email,
		'job' => $request->job,
		'profile_picture' => $request->profile_picture,
	]);

    // fill guarded fields
	$user->organisation_id = Session::get('organisation_id');
	$user->password = 'password';
	$user->uuid = Str::uuid();

    // save to the database
	$user->save();
});