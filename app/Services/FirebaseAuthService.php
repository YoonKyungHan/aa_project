<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

class FirebaseAuthService
{
    protected $auth;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(config('firebase.credentials.file'));

        $this->auth = $factory->createAuth();
    }

    public function sendVerificationCode(string $phoneNumber)
    {
        // Firebase PHP SDK는 직접적으로 SMS를 보내는 기능을 제공하지 않습니다.
        // 대신, 클라이언트 측에서 Firebase JS SDK를 사용하여 SMS를 보낼 수 있습니다.
    }

    public function verifyCode(string $phoneNumber, string $verificationCode)
    {
        // Firebase PHP SDK는 직접적으로 SMS 코드를 검증하는 기능을 제공하지 않습니다.
        // 대신, 클라이언트 측에서 Firebase JS SDK를 사용하여 코드를 검증할 수 있습니다.
    }
}