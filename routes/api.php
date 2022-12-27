<?php

use App\Http\Controllers\firstcontroller;
use Illuminate\Http\Request;
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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('check_id',[firstcontroller::class,"check"])->middleware(['check_token']);
Route::post('check_userr',[firstcontroller::class,"check_user"]);
Route::post('check_product',[firstcontroller::class,"deleteproduct"])->middleware(['check_token']);
Route::post('tes',[firstcontroller::class,"test"]);

