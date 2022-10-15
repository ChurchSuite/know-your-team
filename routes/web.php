<?php

use App\Models\Organisation;
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
Route::get('/user', fn() => view('user'));
Route::get('/settings', function() {
	$organisationId = Session::get('organisation_id');

	return view('settings', [
		'organisation' => Organisation::where(['id' => $organisationId])->first(),
	]);
});

Route::get('/team', fn() => view('team'));

Route::get('/organisation/{organisation:uuid}', function(Request $request, Organisation $organisation) {
	Session::put('organisation_id', $organisation->id);
	return view('organisation', ['organisation' => $organisation]);
});

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