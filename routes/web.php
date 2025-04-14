<?php

use App\Http\Controllers\ActionLogController;
use App\Http\Controllers\PrisonerController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});

Route::prefix('app')->group(function () {
    Route::redirect('/', '/app/prisoners');
    Route::resource('prisoners', PrisonerController::class);
    Route::post('/prisoners/{prisoner}/move-cell', [PrisonerController::class, 'moveCell'])
        ->name('prisoners.move-cell');
    Route::resource('logs', ActionLogController::class);
    Route::get('/cells', [PrisonerController::class, 'cellStatus'])->name('cells.status');
});

require __DIR__.'/auth.php';