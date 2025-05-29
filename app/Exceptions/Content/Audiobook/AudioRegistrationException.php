<?php

namespace App\Exceptions\Content\Audiobook;

use App\Traits\ApiResponse;
use Exception;

class AudioRegistrationException extends Exception
{
      use ApiResponse;

     public function render()
    {
        return $this->error('فشل في تسجيل معلومات الصوت',$this->getMessage(),500);
    }
}
