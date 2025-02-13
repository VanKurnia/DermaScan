<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkinDiseaseAPI;

Route::get('/', function () {
    return view('components/landing-page');
});

Route::get('/login', function () {
    return view('components/login');
});

Route::get('/register', function () {
    return view('components/register');
});

Route::get('/dashboard', function () {
    return view('components/dashboard');
});

Route::get('/history', function () {
    return view('components/history');
});

Route::get('/pay-per-use', function () {
    return view('components/pay-per-use');
});

Route::get('/subscription', function () {
    return view('components/subscription');
});

// scan gambar
Route::post('/scan-image', [SkinDiseaseAPI::class, 'scanImage'])->name('scan.image');

// menampilkan hasil scan
Route::get('/scan-result', function () {
    return view('components/scan-result');
});

// Testing

Route::get('/test-skin-api', [SkinDiseaseAPI::class, 'testGet']);

Route::post('/post-skin-api', [SkinDiseaseAPI::class, 'postDisease']);

Route::get('/skin-disease', function () {
    return view('components/skin-disease');
});

// Route::get('/', function () {
//     return view('welcome');
// });