<?php
header("Access-Control-Allow-Origin: *");
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/sources/index', 'App\Http\Controllers\SourcesController@newestIndex');
Route::get('/sources/now', 'App\Http\Controllers\SourcesController@newest');
Route::get('/sources/list', 'App\Http\Controllers\SourcesController@list');
Route::get('/sources/list/new', 'App\Http\Controllers\SourcesController@latest');
Route::get('/sources/list/{index}', 'App\Http\Controllers\SourcesController@byIndex');
Route::post('/sources/create', 'App\Http\Controllers\SourcesController@create');

Route::post('/uploads/create', 'App\Http\Controllers\UploadsController@create');
Route::get('/uploads/index', 'App\Http\Controllers\UploadsController@index');
