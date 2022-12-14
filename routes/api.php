<?php

use App\Models\Organisation;
use App\Models\OrganisationTest;
use App\Models\Team;
use App\Models\TestResult;
use App\Models\User;
use App\Http\Resources\UserResource;
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

Route::get('/data', function (Request $request) {
    $users = User::where(['organisation_id' => Session::get('organisation_id')])
        ->get()
        ->filter(function ($user) use ($request) {
            return TestResult::where(['user_id' => $user->id, 'test_identifier' => $request->test_identifier])
                ->get()
                ->isNotEmpty();
    });
    return UserResource::collection($users);
});

Route::post('/add_to_team', function(Request $request) {
    $request->validate([
        'team_id' => 'required|int',
        'user_uuid' => 'required|uuid',
    ]);

    // only allow teams that belong to the current organisation
    if (Team::find($request->team_id)->organisation->id != Session::get('organisation_id')) {
        throw new \Exception();
    }

    $user = User::where(['uuid' => $request->user_uuid])->first();

    // only allow adding to team if not already part of it
    if ($user->teams->filter(fn($team) => $team->id == $request->team_id)->isEmpty()) {
        $user->teams()->attach($request->team_id);
    }

    return response()->json(['redirect' => '/']);
});

// POST /api/organisation
Route::post('/organisation', function(Request $request) {
    $request->validate([
        'name' => 'required|string|max:50',
        'first_name' => 'required|string|max:50',
        'last_name' => 'required|string|max:50',
        'email' => 'required|email',
        'job' => 'required|string|max:50',
        'profile_picture' => 'url',
        'tests' => 'required', // check against enum
    ]);

	$organisation = new Organisation(['name' => $request->name]);

    // fill guarded fields
	$organisation->uuid = Str::uuid();

    // save to the database
	$organisation->save();

    // store the test types in the database
    collect($request->tests)
        ->each(function ($test) use ($organisation) {
            $test = new OrganisationTest(['test_identifier' => $test]);
            $test->organisation_id = $organisation->id;
            $test->save();
        });

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

    return response()->json(['redirect' => '/organisation/'.$organisation->uuid]);
});

// PUT /api/organisation/:uuid
Route::put('/organisation/{organisation:uuid}', function(Request $request, Organisation $organisation) {
    $request->validate([
        'name' => 'required|string|max:50',
    ]);

	$organisation->name = $request->name;

    // save to the database
	$organisation->save();

	return response()->json(['redirect' => '/']);
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

	return response()->json(['redirect' => '/']);
});

// PUT /api/team/:uuid
Route::put('/team/{team:id}', function(Request $request, Team $team) {
    $request->validate([
		'name' => 'required|string|max:50',
    ]);

	$team->name = $request->name;

    // save to the database
	$team->save();

	return response()->json(['redirect' => '/']);
});

// POST /api/submit
Route::post('/submit', function(Request $request) {
    $request->validate([
        'test_identifier' => 'required|string|max:50',
        'user_uuid' => 'required|uuid',
    ]);

    $user = User::where(['uuid' => $request->user_uuid])->first();

    $resultJSON = json_encode($request->{$request->test_identifier});

    // delete any existing data for this personality test
    TestResult::where([
        'test_identifier' => $request->test_identifier,
        'user_id' => $user->id,
    ])->delete();

    $result = new TestResult([
        'test_identifier' => $request->test_identifier,
        'user_id' => $user->id,
        'result' => $resultJSON,
    ]);
    $result->save();

    return response()->json(['redirect' => '/']);
});

// POST /api/user
Route::post('/user', function(Request $request) {
    $request->validate([
        'first_name' => 'required|string|max:50',
        'last_name' => 'required|string|max:50',
        'email' => 'required|email',
        'job' => 'required|string|max:50',
        'profile_picture' => 'url',
    ]);

	$user = new User([
		'first_name' => $request->first_name,
		'last_name' => $request->last_name,
		'email' => $request->email,
		'job' => $request->job,
		'profile_picture' => $request->profile_picture ?? '',
	]);

    // fill guarded fields
	$user->organisation_id = Session::get('organisation_id');
	$user->password = 'password';
	$user->uuid = Str::uuid();

    // save to the database
	$user->save();

	return response()->json(['redirect' => '/']);
});

// PUT /api/user/:uuid
Route::put('/user/{user:uuid}', function(Request $request, User $user) {
    $request->validate([
        'first_name' => 'required|string|max:50',
        'last_name' => 'required|string|max:50',
        'email' => 'required|email',
        'job' => 'required|string|max:50',
        'profile_picture' => 'url',
    ]);

	$user->first_name = $request->first_name;
	$user->last_name = $request->last_name;
	$user->email = $request->email;
	$user->job = $request->job;
	$user->profile_picture = $request->profile_picture ?? '';

    // save to the database
	$user->save();

	return response()->json(['redirect' => '/']);
});