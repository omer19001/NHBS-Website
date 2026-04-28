<?php

use App\Http\Controllers\ApplicantController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ApplicantController::class, 'create'])->name('applicant.form');
Route::post('/apply', [ApplicantController::class, 'store'])->name('applicant.store');
Route::get('/success', [ApplicantController::class, 'success'])->name('applicant.success');
