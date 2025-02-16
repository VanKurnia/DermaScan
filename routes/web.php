<?php

use App\Models\HistoryScan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SkinDiseaseAPI;
use App\Http\Controllers\SocialiteController;

Route::get('/', function () {
    return view('components/landing-page');
});

// AUTH

Route::get('auth/google', [SocialiteController::class, 'googleLogin'])
    ->name('auth.google');

Route::get('auth/google/callback', [SocialiteController::class, 'googleAuthentication']);

Route::get('profile/edit', function () {
    return view('profile/edit');
})->middleware(['auth', 'verified'])->name('profile.edit');

Route::get('profile/password', function () {
    return view('profile/password');
})->middleware(['auth', 'verified'])->name('profile.password');

// MENU

Route::get('/dashboard', function () {
    return view('components/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/history', function () {

    $history = HistoryScan::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->paginate(5);

    // dd($history);

    return view('components/history', compact('history'));
})->middleware(['auth', 'verified'])->name('history');


Route::get('/history-details/{id}', [MainController::class, 'historyDetails'])
    ->middleware(['auth', 'verified']);

Route::delete('/history/{id}', [MainController::class, 'historyDelete'])->name('history.destroy');


// MONETIZATION

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
})->middleware(['auth', 'verified'])->name('scan.result');

// Testing

Route::get('/test-skin-api', [SkinDiseaseAPI::class, 'testGet']);

Route::post('/post-skin-api', [SkinDiseaseAPI::class, 'postDisease']);

Route::get('/skin-disease', function () {
    return view('components/skin-disease');
});

// Route::get('/', function () {
//     return view('welcome');
// });