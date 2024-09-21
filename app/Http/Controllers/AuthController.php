<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FirebaseAuthService;

class AuthController extends Controller
{
    protected $firebaseAuth;

    public function __construct(FirebaseAuthService $firebaseAuth)
    {
        $this->firebaseAuth = $firebaseAuth;
    }

    public function sendCode(Request $request)
    {
        $phoneNumber = $request->input('phone');
        $this->firebaseAuth->sendVerificationCode($phoneNumber);
        return response()->json(['message' => 'Verification code sent']);
    }

    public function verifyCode(Request $request)
    {
        $phoneNumber = $request->input('phone');
        $verificationCode = $request->input('code');
        $verified = $this->firebaseAuth->verifyCode($phoneNumber, $verificationCode);
        return response()->json(['verified' => $verified]);
    }
}
