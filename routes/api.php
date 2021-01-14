<?php

use Illuminate\Http\Request;
use App\Http\Controllers\DevelopersController;
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

Route::prefix('developer')->group(function() 
{
    Route::get('/{id?}', function ($id = null,Request $request) {
        $page = $request->input("p");
        $quantity = $request->input("q");
        $devController = new DevelopersController();
        
        return $devController->get($id,$page,$quantity);
    });

    Route::post('/',[DevelopersController::class,'set']);

    Route::put('/{id}',[DevelopersController::class,'set']);

    Route::delete('/{id}',[DevelopersController::class,'delete']);
});