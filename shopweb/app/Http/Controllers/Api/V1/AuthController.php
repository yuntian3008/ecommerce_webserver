<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        $admin = Administrator::where('username', $request->username)->first();
        if ($admin && Hash::check($request->password, $admin->password))
            return response()->json([
                'access_token' => $admin->createToken('Personal Access Token')->accessToken,
                'info' => $admin
            ],200);
        else {
            return response()->json([
                'message' => 'Invalid credentials'
            ],401);
        }

    }
}
