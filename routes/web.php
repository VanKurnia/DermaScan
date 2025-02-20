<?php

use Carbon\Carbon;
use App\Models\HistoryScan;
use App\Models\PremiumServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SkinDiseaseAPI;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\SocialiteController;

Route::get('/', function () {
    return view('components/landing-page');
});

// MIDTRANS
Route::post('/payment', [PaymentController::class, 'createTransaction'])
    ->middleware('auth');

// Route untuk menampilkan form pembayaran atau halaman checkout
Route::get('/checkout', [PaymentController::class, 'showCheckoutForm']); // Contoh

// Route untuk update status pembayaran (dari frontend setelah sukses)
Route::post('/payment/update-status', [PaymentController::class, 'updatePaymentStatus']);

// Route untuk menangani callback dari Midtrans (webhook)
Route::post('/midtrans/callback', [PaymentController::class, 'handleMidtransCallback']);

Route::post('/cancelPayment', [PaymentController::class, 'cancelPayment']);

Route::get('/success', [PaymentController::class, 'success']);

// test
Route::get('/payment-success', function () {
    return view('components/payment-success');
})->middleware(['auth', 'verified']);

Route::get('/pending', [PaymentController::class, 'pending']);

// Route::post('/payment', [PaymentController::class, 'createTransaction'])->name('payment.create');
// Route::post('/payment/notification', [PaymentController::class, 'handleNotification'])->name('payment.notification');


// Route::post('/midtrans/notification', [MidtransController::class, 'handleNotification']);

// AUTH

Route::get('auth/google', [SocialiteController::class, 'googleLogin'])
    ->name('auth.google');

Route::get('auth/google/callback', [SocialiteController::class, 'googleAuthentication']);

Route::get('profile/edit', function () {
    $premium_services = PremiumServices::where('user_id', Auth::id())->first();
    if ($premium_services) {
        $premium_info = [
            'premium_scans' => $premium_services->premium_scans,
            'end-date' => Carbon::parse($premium_services->end_date)->format('d-m-Y'),
            'status' => $premium_services->status,
        ];
    } else {
        $premium_info = [
            'premium_scans' => 0,
            'end-date' => '',
            'status' => '',
        ];
    }

    return view('profile/edit', ['premium_info' => $premium_info]);
})->middleware(['auth', 'verified'])->name('profile.edit');

Route::get('profile/password', function () {
    return view('profile/password');
})->middleware(['auth', 'verified'])->name('profile.password');

// MENU

Route::get('/dashboard', function () {
    $premium_services = PremiumServices::where('user_id', Auth::id())->first();
    if ($premium_services) {
        $premium_info = [
            'premium_scans' => $premium_services->premium_scans,
            'status' => $premium_services->status,
        ];
    } else {
        $premium_info = [
            'premium_scans' => 0,
            'status' => '',
        ];
    }

    return view('components/dashboard', ['premium_info' => $premium_info]);
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