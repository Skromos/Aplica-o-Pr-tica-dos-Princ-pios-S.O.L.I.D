<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();

        return [
            'status' => 200,
            'menssagem' => 'Usuários encontrados!!',
            'user' => $users
        ];
    }

    public function me()
    {
        $user = Auth::user();

        return [
            'status' => 200,
            'message' => 'Usuário logado!',
            "usuario" => $user
        ];
    }

    public function store(UserCreateRequest $request)
    {
        $user = $this->userService->createUser($request->all());

        return [
            'status' => 200,
            'menssagem' => 'Usuário cadastrado com sucesso!!',
            'user' => $user
        ];
    }

    public function show(string $id)
    {
        $user = $this->userService->getUserById($id);

        if (!$user) {
            return [
                'status' => 404,
                'message' => 'Usuário não encontrado! Que triste!'
            ];
        }

        return [
            'status' => 200,
            'message' => 'Usuário encontrado com sucesso!!',
            'user' => $user
        ];
    }

    public function update(UserUpdateRequest $request, string $id)
    {
        $user = $this->userService->updateUser($id, $request->all());

        if (!$user) {
            return [
                'status' => 404,
                'message' => 'Usuário não encontrado! Que triste!'
            ];
        }

        return [
            'status' => 200,
            'message' => 'Usuário atualizado com sucesso!!',
            'user' => $user
        ];
    }

    public function destroy(string $id)
    {
        $deleted = $this->userService->deleteUser($id);

        if (!$deleted) {
            return [
                'status' => 404,
                'message' => 'Usuário não encontrado! Que triste!'
            ];
        }

        return [
            'status' => 200,
            'message' => 'Usuário deletado com sucesso!!'
        ];
    }
}
