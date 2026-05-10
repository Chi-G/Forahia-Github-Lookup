<?php

use App\Livewire\Home;
use App\Livewire\UserDetail;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');

Route::get('/user/{login}', UserDetail::class)->name('user.detail');

Route::view('/about', 'about')->name('about');
