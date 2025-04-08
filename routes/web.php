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
    Route::resource('logs', ActionLogController::class);
});