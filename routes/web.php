<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BuildController;

// Ensure that the BuildController class exists in the specified namespace
// If it does not exist, create the BuildController class in the App\Http\Controllers namespace
use App\Http\Controllers\CompatibilityController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function(){
    return view('login');
});
Route::get('/signup', function(){
    return view('signup');
});
Route::get('/index', function(){
    return view('index');
});

Route::get('/build', [BuildController::class, 'index'])->name('build.index');
Route::post('/build/check', [CompatibilityController::class, 'check'])->name('build.check');
