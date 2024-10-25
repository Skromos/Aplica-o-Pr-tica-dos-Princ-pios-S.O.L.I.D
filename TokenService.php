<?php

namespace App\Services;

use App\Models\User;
use Laravel\Passport\TokenRepository;

class TokenService implements TokenServiceInterface
{
    protected $tokenRepository;

    public function __construct(TokenRepository $tokenRepository)
    {
        $this->tokenRepository = $tokenRepository;
    }

    public function createToken(User $user)
    {
        return $user->createToken($user->email)->accessToken;
    }

    public function revokeToken(User $user)
    {
        $tokenId = $user->token()->id;
        $this->tokenRepository->revokeAccessToken($tokenId);
    }
}
