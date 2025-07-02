<?php

use App\Http\Controllers\ActionLogController;
use App\Http\Controllers\PrisonerController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});
Route::get('/register', function () {
    return redirect()->route('register');
});

use App\Http\Middleware\CheckGroup;

Route::middleware(['auth', CheckGroup::class . ':director'])->group(function () {
    Route::get('/director-register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'createForDirector'])->name('director.register');
    Route::post('/director-register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'storeForDirector']);
});

use App\Http\Middleware\CheckRole;

Route::prefix('app')->group(function () {
    Route::redirect('/', '/app/prisoners');

    // Manually define prisoner resource routes to apply middleware on create and store
    Route::get('prisoners', [PrisonerController::class, 'index'])->name('prisoners.index');
    Route::get('prisoners/create', [PrisonerController::class, 'create'])
        ->middleware([CheckRole::class . ':prisoner_make'])
        ->name('prisoners.create');
    Route::post('prisoners', [PrisonerController::class, 'store'])
        ->middleware([CheckRole::class . ':prisoner_make'])
        ->name('prisoners.store');
    Route::get('prisoners/{prisoner}', [PrisonerController::class, 'show'])->name('prisoners.show');
    Route::get('prisoners/{prisoner}/edit', [PrisonerController::class, 'edit'])->name('prisoners.edit');
    Route::put('prisoners/{prisoner}', [PrisonerController::class, 'update'])->name('prisoners.update');
    Route::delete('prisoners/{prisoner}', [PrisonerController::class, 'destroy'])->name('prisoners.destroy');

    Route::post('/prisoners/{prisoner}/move-cell', [PrisonerController::class, 'moveCell'])
        ->name('prisoners.move-cell');
    Route::resource('logs', ActionLogController::class);
    Route::get('/cells', [PrisonerController::class, 'cellStatus'])->name('cells.status');
});

require __DIR__.'/auth.php';