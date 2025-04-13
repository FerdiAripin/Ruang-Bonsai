<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

Route::get('/admin-login', function () {
    if (Auth::check() && Auth::user()->roles == 'Admin') {
        return redirect('/admin');
    }

    return redirect('/dashboard');
})->middleware(['auth']);
