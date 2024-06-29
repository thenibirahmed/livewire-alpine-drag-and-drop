<?php

use App\Livewire\Task;
use Illuminate\Support\Facades\Route;

Route::get('/', Task::class)
    ->name('home');

Route::get('dashboard', Task::class)
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
