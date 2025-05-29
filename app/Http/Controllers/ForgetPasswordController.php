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
                        
            $resetLink = url("/reset-password?token=$token");
            
            if (!event(new UserResetPasswordEvent($user,$resetLink))) {
                throw new CodeSendingException('فشل إرسال الرابط');
            }
            
        return $this->success('تم إرسال رابط الاستعادة إلى بريدك');
    }

    public function resetPassword(TokenAndPasswordRequest $request, UserRepository $userRepository) 
    {
            $user = auth()->user()->route('token');
    
            $userRepository->update($user,['password' => Hash::make($request->password)]);
                
        return $this->success('تم تغيير كلمة المرور بنجاح');
    }
}