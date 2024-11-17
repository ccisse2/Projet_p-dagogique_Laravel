<?php

use App\Http\Controllers\SortieController;
use App\Models\Campus;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/profile', function () {
    // Only verified users may access this route...
})->middleware(['auth', 'verified']);

Route::get('/sorties', [SortieController::class, 'index'])->name('sorties.index')->middleware('auth');
Route::post('/sorties', [SortieController::class, 'store'])->name('sorties.store');

Route::get('/sorties/create', [SortieController::class, 'create'])->name('sorties.create');

Route::get('/sorties/details/{id}', [SortieController::class, 'details'])->name('sorties.details')->middleware('auth');

Route::post('/sorties/{id}/inscription', [SortieController::class,'subscribeToSortie'])->name('sorties.inscrire')->middleware('auth');


