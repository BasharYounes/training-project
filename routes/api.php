<?php

use App\Http\Controllers\ChannelController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\MediaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register',[AuthController::class,'Register']);
Route::post('/login',[AuthController::class,'login'])->middleware('throttle:5,1');
Route::post('/verify-code',[AuthController::class,'VerifyCode']);
Route::post('/resend-code',[AuthController::class,'ResendCode'])->middleware('throttle:3,10');




Route::middleware('auth:sanctum')->group( function () {
    Route::post('/forget-password',[ForgetPasswordController::class,'forgotPassword']);
    Route::post('/reset-password',[ForgetPasswordController::class,'resetPassword']);
    Route::post('/refresh-token',[AuthController::class,'refreshToken']);
    Route::post('/upload-file',[MediaController::class,'uploadProfileImage']);
    Route::post('/create-channel',[ChannelController::class,'store']);
    Route::post('/create-podcast/{channel_id}',[ContentController::class,'storePodcast']);
    Route::post('/create-audiobook/{channel_id}',[ContentController::class,'storeAudiobook']);
    Route::post('/podcasts/{podcast_id}/comments', [CommentController::class, 'store']);
    Route::get('/podcasts/{podcast_id}/comments', [CommentController::class, 'index']);

});
