<?php

namespace App\Http\Controllers;

use App\Models\HistoryScan;
use App\Models\PremiumServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SkinDiseaseAPI extends Controller
{

    // testing api
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

    // ujicoba
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

        // dd(config('app.ai_api'));

        try {
            $response = Http::attach(
                'im', // Sesuaikan dengan API
                file_get_contents($file->getRealPath()),
                $file->hashName() // Randomisasi nama file
            )->post(config('app.ai_api'));
            // )->post('http://localhost:9000/detect');

            // Debugging API response
            // dd($response->json());

            if ($response->successful()) {

                // ubah format data agar mudah digunakan
                $responseData   = $response->json();
                $otherResult    = $responseData['predictions'];
                $responseData   = $responseData['predictions'][0];

                // return response()->json([
                //     'responseData' => $responseData,
                //     'otherResult' => $otherResult
                // ]);

                // Simpan hasil scan ke database :
                $premium_service = PremiumServices::where('user_id', Auth::id())->first();

                if ($premium_service && $premium_service['status'] === 'premium') {
                    $path = $request->file('image')->store('uploads', 'public');
                    HistoryScan::create([
                        'user_id' => Auth::id(),
                        'image_url' => $path,
                        'disease_name' => $responseData['disease'],
                        'confidence' => $responseData['probability'],
                        'diagnosis_text' => $responseData,
                        'other_result' => $otherResult,
                        // 'other_result' => json_encode($otherResult),
                        // 'recommended_action' => $responseData['recommendation'],
                    ]);
                } elseif ($premium_service && $premium_service['premium_scans'] > 0) {
                    $path = $request->file('image')->store('uploads', 'public');
                    $premium_service['premium_scans'] = $premium_service['premium_scans'] - 1;
                    $premium_service->save();

                    HistoryScan::create([
                        'user_id' => Auth::id(),
                        'image_url' => $path,
                        'disease_name' => $responseData['disease'],
                        'confidence' => $responseData['probability'],
                        'diagnosis_text' => $responseData,
                        'other_result' => $otherResult,
                        // 'other_result' => json_encode($otherResult),
                        // 'recommended_action' => $responseData['recommendation'],
                    ]);
                } else {
                    unset($responseData['symptoms']);
                    unset($responseData['causes']);
                    unset($responseData['treatments']);
                    $otherResult = [];

                    // jika pengguna gratis ingin di save
                    // HistoryScan::create([
                    //     'user_id' => Auth::id(),
                    //     'image_url' => $path,
                    //     'disease_name' => $responseData['disease'],
                    //     'confidence' => $responseData['probability'],
                    //     'diagnosis_text' => $responseData,
                    //     // 'recommended_action' => $responseData['recommendation'],
                    // ]);
                }

                return view('components.scan-result', [
                    'data' => $responseData,
                    'back' => '/dashboard',
                    'otherResult' => $otherResult,
                    'preview' => 'data:image/' . $file->extension() . ';base64,' . $fileContent,
                ]);
            }
            return response()->json(['error' => 'Failed to fetch data'], $response->status());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
