<?php 

namespace App\Repositories;

use App\Models\PasswordResetToken;
use App\Models\User;
use Exception;

class UserRepository {
    public function findByEmail($email) {
        return User::where('email', $email)->firstOrFail();
    }

    public function update(User $user, array $data) {
        $user->update($data);
        return $user;
    }

  

    public function deleteUserToken($user)
    {
        if ($user->tokens()->exists()) {
            $user->tokens()->delete();
        }
    }

     public function createToken($user)
    {
        return $user->createToken('password-reset-token')->plainTextToken;
    }
}