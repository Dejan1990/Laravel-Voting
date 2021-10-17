<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::view('/idea', 'show');

require __DIR__.'/auth.php';
