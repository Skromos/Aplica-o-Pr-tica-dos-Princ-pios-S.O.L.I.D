<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function authenticate(string $email, string $password)
    {
        if (Auth::attempt(['email' => strtolower($email), 'password' => $password])) {
            return auth()->user();
        }
        return null;
    }
}