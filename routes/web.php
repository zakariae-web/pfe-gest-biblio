<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CopyController;
use App\Http\Controllers\EmpruntController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ReservationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('document', DocumentController::class);
Route::resource('copie', CopyController::class);
Route::resource('reservation', ReservationController::class)->middleware('auth');
Route::put('/documents/{document_id}/validerEmprunt', [DocumentController::class, 'validerEmprunt'])->name('documents.validerEmprunt');
Route::post('/reservation/{document_id}/reserver', [ReservationController::class, 'reserverDocument']);
Route::resource('emprunts', EmpruntController::class);

