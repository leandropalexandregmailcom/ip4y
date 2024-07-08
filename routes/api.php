<?php

use App\Http\Controllers\ApiController;

Route::get('/forms', [ApiController::class, 'getForms']);
Route::get('/forms/{id}', [ApiController::class, 'getForm']);
Route::post('/forms', [ApiController::class, 'createForm']);
Route::put('/forms/{id}', [ApiController::class, 'updateForm']);
Route::delete('/forms/{id}', [ApiController::class, 'deleteForm']);

