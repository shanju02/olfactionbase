<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AromaWheelController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NestedGraphData;
use App\Http\Controllers\OdorantController;
use App\Http\Controllers\OdorController;
use App\Http\Controllers\OlfactionWheelController;
use App\Http\Controllers\OrOdorantController;
use App\Http\Controllers\ProteinController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\ReceptorController;
use App\Http\Controllers\ToolsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/aroma', [AromaWheelController::class, 'index'])->name('aroma');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');


Route::get('/olfaction-wheel', [OlfactionWheelController::class, 'index'])->name('olfaction.wheel');
Route::get('/odorant-binding-protein', [ProteinController::class, 'index'])->name('protein');
Route::get('/publication', [PublicationController::class, 'index'])->name('publication');
Route::get('/tools', [ToolsController::class, 'index'])->name('tools');

// Api for json data
Route::get('/odor/{odor}/subodors', [OdorController::class, 'odorWiseSubOdors'])->name('odor.wise.sub.odors');
Route::get('/sub-odor/{subodor_id}/odorants', [OdorantController::class, 'getSubOdorWiseOdorant'])->name('subodor.wise.odorant');
Route::get('/nested/{type}/{page}', [NestedGraphData::class, 'index'])->name('nested.graph.data');

Route::get('/odor', [OdorController::class, 'index'])->name('odor');

Route::get('/chemicals/{odorless?}', [OdorantController::class, 'index'])->name('odorant');
Route::get('/chemical/{odorant}', [OdorantController::class, 'view'])->name('odorant.view');


Route::get('/receptor', [ReceptorController::class, 'index'])->name('receptor');
Route::get('/receptor/{receptor}', [ReceptorController::class, 'view'])->name('receptor.view');

Route::get('/or-odorant-pairs', [OrOdorantController::class, 'index'])->name('or.odorant');
Route::get('/or-odorant-pairs/{or_odorant}', [OrOdorantController::class, 'view'])->name('or.odorant.view');

Route::post('/get-evidences', [OrOdorantController::class, 'getEvidences'])->name('or.odorant.get.evidences');


