<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;

class QrCodeController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::user();
        
        // We encode the User ID. In a real app, this should be a signed token or encrypted string.
        $payload = (string) $user->id;

        // Generate SVG
        $qr = QrCode::size(200)->generate($payload);

        // Return as SVG string or Base64
        // For API, returning the payload and maybe a base64 image is good.
        // But QrCode::generate returns a string (SVG XML).
        
        return response()->json([
            'payload' => $payload,
            'svg' => (string) $qr,
        ]);
    }
}
