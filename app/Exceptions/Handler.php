<?php

namespace App\Exceptions;

use App\Exceptions\Content\Audiobook\AudioRegistrationException;
use App\Exceptions\Content\ContentRegistrationException;
use App\Exceptions\Content\Podcast\PodcastRegistrationException;
use App\Exceptions\FileStorageException;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{

    
    /**
     * Register custom exception handling.
     */
    public function register(): void
    {
    //     $this->renderable(function (RegistrationFailedException $e) {
    //         return $e->render();
    //     });

    //     $this->renderable(function (CodeSendingException $e) {
    //         return $e->render();
    //     });

    //     $this->renderable(function (InvalidCodeException $e) {
    //         return $e->render();
    //     });

    //     $this->renderable(function (InvalidCredentialsException $e) {
    //         return $e->render();
    //     });

    //     $this->renderable(function(FileStorageException $e){
    //         return $e->render();
    //     });

    //     $this->renderable(function(AudioRegistrationException $e){
    //         return $e->render();
    //     });

    //     $this->renderable(function(PodcastRegistrationException $e){
    //         return $e->render();
    //     });

    //     $this->renderable(function(ContentRegistrationException $e){
    //         return $e->render();
    //     });

    //     $this->renderable(function (Throwable $e, $request) {
    //         return response()->view('errors.custom', [], 500);
    //     });

    //     $this->renderable(function (Exception $e) {
    //         return response()->json([
    //             'message' => 'حدث خطأ غير متوقع',
    //             'error' =>  $e->getMessage() 
    //         ], 500);
    //     });
    }

    public function render($request, Throwable $e)
    {
        // Handle specific exceptions first
        switch (true) {
            case $e instanceof RegistrationFailedException:
                return $e->render();
                
            case $e instanceof CodeSendingException:
                return $e->render();
                
            case $e instanceof InvalidCodeException:
                return $e->render();
                
            case $e instanceof InvalidCredentialsException:
                return $e->render();
                
            case $e instanceof FileStorageException:
                return $e->render();
                
            case $e instanceof AudioRegistrationException:
                return $e->render();
                
            case $e instanceof PodcastRegistrationException:
                return $e->render();
                
            case $e instanceof ContentRegistrationException:
                return $e->render();
                
            case $e instanceof Exception:
                return response()->json([
                    'message' => 'حدث خطأ غير متوقع',
                    'error' => $e->getMessage() 
                ], 500);
                
            default:
                return response()->view('errors.custom', [], 500);
        }
    }
}