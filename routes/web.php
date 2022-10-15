<?php

use App\Models\Organisation;
use Illuminate\Support\Facades\Route;
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

Route::get('/', fn() => view('home'));
Route::get('/register', fn() => view('register'));
Route::get('/member', fn() => view('member'));
Route::get('/team', fn() => view('team'));
Route::get('/data', fn() => view('data'));

Route::get('/organisation/{organisation:uuid}', function(Request $request, Organisation $organisation) {
	return $organisation->name;
});