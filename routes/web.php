<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('emails.client_identifiant');
});

