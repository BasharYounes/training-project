<?php

namespace App\Exceptions\Content;

use App\Traits\ApiResponse;
use Exception;

class ContentCreatenException extends Exception
{
      use ApiResponse;

     public function render()
    {
        return $this->error('فشل في عملية إنشاء المحتوى الخاص بك ..! أعد المحاولة لاحقا' ,$this->getMessage(),500);
    }
}
