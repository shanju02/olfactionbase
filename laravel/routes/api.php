<?php

use App\Http\Controllers\OdorController;
use App\Http\Controllers\ProteinController;
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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::get('/odors/list', [OdorController::class, 'odorListForAPI'])->name('api.odor.list');
Route::get('/sub-odors/list/{odor_id?}', [OdorController::class, 'subOdorListForAPI'])->name('api.sub.odor.list');
Route::get('/odorant-binding-protein/organism/list', [ProteinController::class, 'organismListForAPI'])
    ->name('api.obp.organism.list');
