<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BespokeController;

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


Route::post('bespoke-ring', [BespokeController::class, 'bespokeRing']);
Route::post('bespoke-earing', [BespokeController::class, 'bespokeEaring']);
Route::post('bespoke-bracelet', [BespokeController::class, 'bespokeBracelet']);
Route::post('bespoke-necklace', [BespokeController::class, 'bespokeNecklace']);
