<?php

use Illuminate\Http\Request;
use App\Http\Controllers\DelevolpersController;
use Illuminate\Support\Facades\Route;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('developer')->group(function() 
{
    Route::get('/',[DevelopersController::class,'get']);

    Route::post('/',[DelevolpersController::class,'set']);

    Route::put('/',[DelevolpersController::class,'set']);

    Route::delete('/',[DelevolpersController::class,'delete']);
});