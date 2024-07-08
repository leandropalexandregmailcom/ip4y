<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

Route::get('/', [FormController::class, 'index'])->name('index');
Route::get('/create', [FormController::class, 'create'])->name('forms.create');
Route::post('/store', [FormController::class, 'store'])->name('forms.store');
Route::get('/edit/{id}', [FormController::class, 'edit'])->name('forms.edit');
Route::post('/update/{id}', [FormController::class, 'update'])->name('forms.update');
Route::post('/delete/{id}', [FormController::class, 'destroy'])->name('forms.destroy');
Route::get('/records', [FormController::class, 'showRecords'])->name('records');
Route::post('/sendToApi/{id}', [FormController::class, 'sendToApi'])->name('forms.sendToApi');
Route::get('/api/forms/{id}', [FormController::class, 'edit']);