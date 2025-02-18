<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Midtrans\Config;
use Midtrans\Transaction as MidtransTransaction;

class MidtransController extends Controller
{
    public function handleNotification(Request $request)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false; // Ubah ke true jika live
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Ambil data dari Midtrans
        $notification = json_decode($request->getContent(), true);
        $orderId = $notification['order_id'];
        $transactionStatus = $notification['transaction_status'];
        $fraudStatus = $notification['fraud_status'] ?? null;

        // Cari transaksi di database
        $transaction = Transaction::where('order_id', $orderId)->first();

        if (!$transaction) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        // Update status transaksi berdasarkan notifikasi dari Midtrans
        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'accept') {
                $transaction->status = 'success';
            }
        } elseif ($transactionStatus == 'settlement') {
            $transaction->status = 'success';
        } elseif ($transactionStatus == 'pending') {
            $transaction->status = 'pending';
        } elseif ($transactionStatus == 'deny') {
            $transaction->status = 'failed';
        } elseif ($transactionStatus == 'expire') {
            $transaction->status = 'expired';
        } elseif ($transactionStatus == 'cancel') {
            $transaction->status = 'canceled';
        }

        $transaction->save();

        return response()->json(['message' => 'Notifikasi diproses']);
    }
}
