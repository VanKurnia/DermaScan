<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkinDiseaseAPI;

Route::get('/', function () {
    return view('components/landing-page');
});

Route::get('/dashboard', function () {
    return view('components/dashboard');
})->middleware(['auth', 'verified']);

Route::get('/history', function () {
    return view('components/history');
})->middleware(['auth', 'verified']);

Route::get('/pay-per-use', function () {
    return view('components/pay-per-use');
})->middleware(['auth', 'verified']);

Route::get('/subscription', function () {
    return view('components/subscription');
})->middleware(['auth', 'verified']);

// scan gambar
Route::post('/scan-image', [SkinDiseaseAPI::class, 'scanImage'])->name('scan.image')->middleware(['auth', 'verified']);

// menampilkan hasil scan
Route::get('/scan-result', function () {
    return view('components/scan-result');
})->middleware(['auth', 'verified']);

// Testing

Route::get('/test-skin-api', [SkinDiseaseAPI::class, 'testGet']);

Route::post('/post-skin-api', [SkinDiseaseAPI::class, 'postDisease']);

Route::get('/skin-disease', function () {
    return view('components/skin-disease');
});

// Route::get('/', function () {
//     return view('welcome');
// });