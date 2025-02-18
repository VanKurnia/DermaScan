<?php

namespace App\Http\Controllers;

use App\Models\PremiumServices;
use Carbon\Carbon;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function createTransaction(Request $request)
    {
        // Generate Order ID unik
        $orderId = 'INV-' . Str::random(10);

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // Buat data transaksi untuk Midtrans
        $transactionDetails = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $request->amount, // Dari request
            ],
            'customer_details' => [
                'email' => Auth::user()->email ?? 'guest@example.com',
            ]
        ];

        try {
            // Generate Snap Token Midtrans
            $snapToken = Snap::getSnapToken($transactionDetails);

            // Simpan transaksi ke database
            // $transaction = Transaction::create([
            Transaction::create([
                'order_id' => $orderId,
                'user_id' => Auth::id(),
                'amount' => $request->amount,
                'payment_status' => 'pending',
                'service_purchased' => $request->service_purchased,
                'response_data' => [], // Kosong dulu, nanti diupdate setelah sukses
            ]);

            return response()->json(['snap_token' => $snapToken, 'order_id' => $orderId]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updatePaymentStatus(Request $request)
    {
        $orderId = $request->input('order_id');
        $paymentStatus = $request->input('payment_status');
        $responseData = $request->input('response_data');
        $service_purchased = $request->input('service_purchased');

        try {
            $transaction = Transaction::where('order_id', $orderId)->first();
            if ($transaction) {
                $transaction->payment_status = $paymentStatus;
                $transaction->response_data = $responseData; // Simpan response Midtrans lengkap
                $transaction->save();

                // cari baris user, jika ada update, jika tidak buat baru
                $premiumservices = PremiumServices::where('user_id', Auth::id())->first();
                // Parse service purchased format
                // $service_type = strtok($service_purchased, '-');
                // $service_amount = strtok('-');
                [$service_type, $service_amount] = explode('-', $service_purchased);


                if ($premiumservices) {
                    // jika ppu
                    if ($service_type == 'PPU') {
                        $premiumservices->premium_scans = $premiumservices->premium_scans + (int) $service_amount;
                        $premiumservices->save();
                    }
                    // jika subscription
                    elseif ($service_type == 'SUB') {
                        $premiumservices->end_date = Carbon::parse($premiumservices->end_date)->addMonths((int) $service_amount);
                        $premiumservices->status = 'premium';
                        $premiumservices->save();
                    }
                } else {
                    // jika ppu
                    if ($service_type == 'PPU') {
                        PremiumServices::create([
                            'user_id' => Auth::id(),
                            'premium_scans' => (int) $service_amount,
                            'status' => '',
                            'end_date' => Carbon::now(),
                        ]);
                    }
                    // jika subscription
                    elseif ($service_type == 'SUB') {
                        PremiumServices::create([
                            'user_id' => Auth::id(),
                            'premium_scans' => 0,
                            'status' => 'premium',
                            'end_date' => Carbon::now()->addMonths((int) $service_amount),
                        ]);
                    }
                }

                return response()->json(['message' => 'Payment status updated successfully']);
            } else {
                return response()->json(['message' => 'Transaction not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function success(Request $request)
    {
        $order_id = $request->query('order_id');
        dd($order_id);
        return view('success', ['order_id' => $order_id]); // Tampilkan view success.blade.php
    }

    public function pending(Request $request)
    {
        $order_id = $request->query('order_id');
        return view('pending', ['order_id' => $order_id]); // Tampilkan view pending.blade.php
    }

    public function handleMidtransCallback(Request $request)
    {
        // 1. Validasi Signature
        $hashedSignature = $request->header('X-Signature'); // Ambil signature dari header
        $orderId = $request->input('order_id');
        $statusCode = $request->input('transaction_status');
        $signatureKey = config('midtrans.server_key'); // Server key Anda

        $rawSignature = $orderId . $request->input('status_code') . $request->input('gross_amount') . $signatureKey;
        $mySignature = hash('sha512', $rawSignature);

        if ($mySignature != $hashedSignature) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // 2. Update Database
        try {
            $transaction = Transaction::where('order_id', $orderId)->first();
            if ($transaction) {
                $transaction->payment_status = $statusCode;
                $transaction->response_data = $request->all(); // Simpan seluruh data callback
                $transaction->save();

                // 3. Berikan Response ke Midtrans
                return response()->json(['message' => 'Callback received successfully']);
            } else {
                return response()->json(['message' => 'Transaction not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
