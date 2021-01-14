<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DevelopersController;
use Illuminate\Http\Request;

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

Route::redirect('/','developers');
Route::get('developers',[DevelopersController::class,'index']);

Route::Fallback(function()
{
    return view('404');
});