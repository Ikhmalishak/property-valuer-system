<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});

Route::get('/muatturundokumen', function () {
    return view('muatturundokumen');
});

Route::get('/test', function () {
    return view('test');
});
