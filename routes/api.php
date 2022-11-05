<?php

use App\Http\Controllers\LayoutController;
use Illuminate\Support\Facades\Route;

Route::get('layouts/value/{layoutId}', [LayoutController::class, 'getValue'])->name('layouts.value');
Route::resource('layouts', LayoutController::class,  ['only' => ['index', 'show', 'store']]);

