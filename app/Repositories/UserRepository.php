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

    public function findToken($token){

        $accessToken = PasswordResetToken::where('token', $token)->first();

        if (!$accessToken) {
                return $this->error('توكن غير صالح', [],400);
            }
    
        return $accessToken;

    }
}