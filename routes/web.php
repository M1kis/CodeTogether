<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PairSessionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pair-session/create', [PairSessionController::class, 'create'])->name('pair.create');
Route::post('/pair-session', [PairSessionController::class, 'store'])->name('pair.store');
Route::get('/pair-session/{id}', [PairSessionController::class, 'show'])->name('pair.show');
Route::post('/pair-session/{id}/switch', [PairSessionController::class, 'switchRoles'])->name('pair.switch');
Route::delete('/pair-session/{id}/end', [PairSessionController::class, 'endSession'])->name('pair.end');
Route::post('/pair-session/{id}/switch-ajax', [PairSessionController::class, 'switchRolesAjax'])
    ->name('pair.switch.ajax');
