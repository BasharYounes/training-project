<?php

namespace App\Exceptions\Content;

use App\Traits\ApiResponse;
use Exception;

class ContentRegistrationException extends Exception
{
    use ApiResponse;

     public function render()
    {
        return $this->error('فشل في تسجيل المحتوى',$this->getMessage(),500);
    }
}
