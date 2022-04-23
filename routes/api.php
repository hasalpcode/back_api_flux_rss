<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use    App\Http\Controllers\FluxController;

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
Route::get('flux',[FluxController::class,'getFlux']);
Route::get('Oneflux/{id}',[FluxController::class,'getOneFlux']);
Route::put('updateflux/{id}',[FluxController::class,'updateFlux']);
Route::post('addflux/{id}',[FluxController::class,'addFlux']);
Route::get('flux_rss',[FluxController::class,'index_flux']);