<?php

use App\Models\Organisation;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(Request $request) {
	try {
		$organisationId = Session::get('organisation_id');
		if (empty($organisationId)) throw new \Exception();
		$organisation = Organisation::find($organisationId);

		return view('organisation', ['organisation' => $organisation]);
	} catch (\Exception $e) {
		return view('register');
	}
});
Route::get('/register', fn() => view('register'));
Route::get('/user', fn() => view('user.create'));
Route::get('/user/{user:uuid}', function(Request $request, User $user) {
	return view('user.update', ['user' => $user]);
});


Route::get('/settings', function() {
	$organisationId = Session::get('organisation_id');

	return view('settings', [
		'organisation' => Organisation::where(['id' => $organisationId])->first(),
	]);
});

Route::get('/team', fn() => view('team.create'));
Route::get('/team/{team:id}', function(Request $request, Team $team) {
	return view('team.update', ['team' => $team]);
});

Route::get('/organisation/{organisation:uuid}', function(Request $request, Organisation $organisation) {
	Session::put('organisation_id', $organisation->id);
	return view('organisation', ['organisation' => $organisation]);
});

Route::get('/test/enneagram', fn() => view('enneagram'));
Route::get('/test/myers_briggs', fn() => view('myers_briggs'));
Route::get('/test/working_genius', fn() => view('working_genius'));

// hacky endpoint to list organisations for time being
Route::get('/organisations', function() {
	return view('organisations', ['organisations' => Organisation::all()]);
});

Route::get('/submit', function() {
	$organisationId = Session::get('organisation_id');
	if (empty($organisationId)) throw new \Exception();
	$organisation = Organisation::find($organisationId);

	return view('submit', ['organisation' => $organisation]);
});

Route::get('/add_to_team', function() {
	$organisationId = Session::get('organisation_id');
	if (empty($organisationId)) throw new \Exception();
	$organisation = Organisation::find($organisationId);

	return view('add_to_team', ['organisation' => $organisation]);
});