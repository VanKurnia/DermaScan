<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SkinDiseaseAPI extends Controller
{
    public function testGet()
    {
        $response = Http::get('http://localhost:9000/test');

        if ($response->successful()) {
            $data = $response->json();
        } else {
            $data = response()->json(
                ['error' => 'Failed to fetch data'],
                $response->status()
            );
        }

        return view('components.dashboard', ['data' => $data]);
    }

    public function postDisease(Request $request)
    {
        $request->validate([
            'image' => 'required|file|mimes:jpg,jpeg,png|max:2048'
        ]);

        $file = $request->file('image');

        $response = Http::attach(
            'im', // nama perlu di random
            file_get_contents($file->getRealPath()),
            // $file->getClientOriginalName()
            $file->hashName() // randomisasi nama file
        )->post('http://localhost:9000/detect');

        if ($response->successful()) {
            $data = $response->json();
        } else {
            return response()->json(
                ['error' => 'Failed to fetch data'],
                $response->status()
            );
        }

        // dd($data);

        return view('components.dashboard', ['data' => $data]);
    }

    public function scanImage(Request $request)
    {
        $request->validate([
            'image' => 'required|file|mimes:jpg,jpeg,png|max:2048'
        ]);

        $file = $request->file('image');
        // encode ke base64 supaya gambar tidak perlu disimpan terlebih dahulu
        $fileContent = base64_encode(file_get_contents($file->getRealPath())); // Encode ke Base64

        try {
            $response = Http::attach(
                'im', // Sesuaikan dengan API
                file_get_contents($file->getRealPath()),
                $file->hashName() // Randomisasi nama file
            )->post('http://localhost:9000/detect');

            // Debugging API response
            // dd($response->json());

            if ($response->successful()) {
                // return response()->json($response->json());
                return view('components.scan-result', [
                    'data' => $response->json(),
                    // 'preview' => $file,
                    'preview' => 'data:image/' . $file->extension() . ';base64,' . $fileContent,
                ]);
            }

            return response()->json(['error' => 'Failed to fetch data'], $response->status());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }


        // SAVE REQUEST
        // $request->validate([
        //     'image' => 'required|image|mimes:jpg,png,jpeg|max:2048', // Maks 2MB
        // ]);

        // // Simpan file ke folder storage/app/public/uploads
        // $path = $request->file('image')->store('uploads', 'public');

        // return view('components.scan-result');

        // return response()->json([
        //     'message' => 'File berhasil diupload!',
        //     'file_path' => asset('storage/' . $path),
        // ]);
    }
}
