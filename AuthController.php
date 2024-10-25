<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Services\TokenServiceInterface;
use Illuminate\Http\Request;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    protected $authService;
    protected $tokenService;

    public function __construct(AuthService $authService, TokenServiceInterface $tokenService)
    {
        $this->authService = $authService;
        $this->tokenService = $tokenService;
    }

    public function login(Request $request)
    {
        $data = $request->all();
        
        $user = $this->authService->authenticate($data['email'], $data['password']);

        if ($user) {
            $user->token = $this->tokenService->createToken($user);
            return [
                'status' => 200,
                'message' => "Usuário logado com sucesso",
                "usuario" => $user
            ];
        } else {
            return [
                'status' => 404,
                'message' => "Usuário ou senha incorreto"
            ];
        }
    }

    public function logout(Request $request)
    {
        $this->tokenService->revokeToken($request->user());

        return ['status' => true, 'message' => "Usuário deslogado com sucesso!"];
    }
}
