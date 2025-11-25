<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\DeleteAccountRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return response()->json(Auth::user());
    }

    public function update(ProfileUpdateRequest $request)
    {
        $user = Auth::user();
        $user->update($request->validated());

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user
        ]);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->validated()['password']),
        ]);

        return response()->json(['message' => 'Password updated successfully']);
    }

    public function destroy(DeleteAccountRequest $request)
    {
        $user = Auth::user();
        
        Auth::logout();
        
        $user->delete();

        return response()->json(['message' => 'Account deleted successfully'], 200);
    }
}
