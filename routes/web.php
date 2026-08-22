<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages::website.landing')->name('homepage');
Route::livewire('/school-sign-up', 'pages::website.signup')->name('schoolsignup');
Route::get('/test-view', function () {
    return view('mail.signup.application-submitted');
});