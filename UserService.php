<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    public function getAllUsers()
    {
        return User::select('id', 'name', 'email', 'created_at')->paginate(10);
    }

    public function createUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function getUserById(string $id)
    {
        return User::find($id);
    }

    public function updateUser(string $id, array $data)
    {
        $user = User::find($id);

        if ($user) {
            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }
            $user->update($data);
        }

        return $user;
    }

    public function deleteUser(string $id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return true;
        }

        return false;
    }
}
