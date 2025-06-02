<?php

namespace App\Http\Controllers;

use App\Events\UserResetPasswordEvent;
use App\Exceptions\CodeSendingException;
use App\Http\Requests\EmailRequest;
use App\Http\Requests\TokenAndPasswordRequest;
use Hash;
use App\Repositories\UserRepository;
use App\Services\PasswordReset;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Password;
use Laravel\Sanctum\PersonalAccessToken;
use Str;


class ForgetPasswordController extends Controller
{
    use ApiResponse;


    public function __construct(
    protected PasswordReset $passwordReset,
    protected UserRepository $userRepository
    )
    {}

    public function forgotPassword(EmailRequest $request) 
    {
            $user = $this->userRepository->findByEmail($request->email);
    
            $token = $this->userRepository->createToken($user);
                        
            $resetLink = url("/api/reset-password?token=$token");
            
            if (!event(new UserResetPasswordEvent($user,$resetLink))) {
                throw new CodeSendingException('فشل إرسال الرابط');
            }
            
        return $this->success('تم إرسال رابط الاستعادة إلى بريدك',$resetLink);
    }

    public function resetPassword(TokenAndPasswordRequest $request) 
    {
            $token = $request->query('token');


            if (!$token) {
                return $this->error('توكن غير صالح', [],400);
            }

            $accessToken = PersonalAccessToken::findToken($token);

            if (!$accessToken) {
                return $this->error('توكن غير صالح', [],400);
            }
            $user = $accessToken->tokenable;

            $user->password = Hash::make($request->password);
            $user->save();

           $this->userRepository->deleteUserToken($user);

        return response()->json(['message' => 'تم تحديث كلمة المرور بنجاح']);
    }
}