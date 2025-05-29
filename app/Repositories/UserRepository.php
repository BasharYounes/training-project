<?php 

namespace App\Repositories;

use App\Models\PasswordResetToken;
use App\Models\User;
use Exception;

class UserRepository {
    public function findByEmail($email) {
        return User::findOrFail('email', $email)->first();
    }

    public function update(User $user, array $data) {
        $user->update($data);
        return $user;
    }

    public function findByToken($token)
    {
            $resetToken = PasswordResetToken::where('token', $token)->first();

            if (!$resetToken) {
                    throw new Exception("الرابط غير صالح أو غير موجود");
                }
        return $resetToken;
    }

    public function deleteUserToken($user)
    {
        $user->tokens()->delete();;
    }

     public function createToken($user)
    {
        return $user->createToken('auth-token')->plainTextToken;
    }
}