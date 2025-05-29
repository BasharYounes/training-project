<?php

namespace App\Exceptions\Content\Podcast;

use App\Traits\ApiResponse;
use Exception;

class PodcastRegistrationException extends Exception
{
      use ApiResponse;

     public function render()
    {
        return $this->error('فشل في تسجيل معلومات البودكاست',$this->getMessage(),500);
    }
}
