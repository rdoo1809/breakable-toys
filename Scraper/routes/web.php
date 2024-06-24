<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/scraper', [\App\Http\Controllers\ScraperController::class, 'index']);
Route::get('/raw', [\App\Http\Controllers\ScraperController::class, 'rawData']);
//
Route::get('/sites', [\App\Http\Controllers\ScraperController::class, 'getSites']);


