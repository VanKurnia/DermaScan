<?php

namespace App\Http\Controllers;

use App\Models\HistoryScan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    public function historyDetails($id)
    {
        $history = HistoryScan::where('user_id', Auth::id()) // Pastikan hanya bisa melihat history miliknya sendiri
            ->where('id', $id)
            ->firstOrFail();

        // dump($history);
        // dd($history['diagnosis_text']);

        $data = $history['diagnosis_text'];
        $otherResult = $history['other_result'];

        // Menyiapkan preview gambar dari url ke base64
        $filePath = storage_path('app/public/' . $history['image_url']);
        $fileContent = base64_encode(file_get_contents($filePath));
        $mimeType = mime_content_type($filePath);
        $preview = 'data:' . $mimeType . ';base64,' . $fileContent;

        return view('components.scan-result', [
            'data' => $data,
            'otherResult' => $otherResult,
            'preview' => $preview,
        ]);
    }

    public function historyDelete($id)
    {
        $history = HistoryScan::where('user_id', Auth::id()) // Pastikan hanya menghapus milik user sendiri
            ->where('id', $id)
            ->firstOrFail(); // Jika tidak ditemukan, tampilkan 404

        $fileName = str_replace('uploads/', '', $history->image_url);

        // hapus file gambar
        Storage::disk('public')->delete("uploads/$fileName");

        // Hapus data history dari database
        $history->delete();

        // return redirect()->route('/history')->with('success', 'Riwayat scan berhasil dihapus.');
        return redirect()->route('history');
    }
}
