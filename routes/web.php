<?php

use App\Http\Controllers\StudentManagementController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'stutdent.'], function() {
    Route::get('/', [StudentManagementController::class, 'index'])->name('index');
    Route::get('/create', [StudentManagementController::class, 'create'])->name('create');
    Route::post('/store', [StudentManagementController::class, 'store'])->name('store');
    Route::delete('/delete/{studentMark}', [StudentManagementController::class, 'destroy'])->name('destroy');
});
