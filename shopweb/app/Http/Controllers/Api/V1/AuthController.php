<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Passport;

class AuthController extends Controller
{
    public function __construct() {
        $this->middleware(['auth:api'])->except(['login']);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = Administrator::where('username', $request->username)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            $scopes =  $admin->administratorScopes->pluck('scope')->toArray();
            foreach($admin->tokens as $token)
                $token->revoke();
            return response()->json([
                'access_token' => $admin->createToken('Personal Access Token',$scopes)->accessToken,
            ],200);
        }

        else {
            return response()->json([
                'message' => 'Thông tin đăng nhập không hợp lệ'
            ],401);
        }
    }

    public function user(Request $request) {
        $user = $request->user()->toArray();
        $user['scope'] = $request->user()->token()->scopes;
        $user['scope_info'] = Passport::scopesFor($request->user()->token()->scopes);
        return response()->json([
            'user' => $user
        ],200);
    }

    public function logout(Request $request) {
        $user = $request->user();
        $user->token()->revoke();
        return response()->json([],200);
    }
}
