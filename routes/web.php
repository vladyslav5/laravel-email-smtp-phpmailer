<?php

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EmailController::class, 'showForm'])->name('email.create');
Route::post('/', [EmailController::class, 'send'])->name('email.send');

Route::get('/{email:uuid}/success', [EmailController::class, 'success'])->name('email.success');
