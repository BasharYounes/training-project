<?php

namespace App\Exceptions;

use App\Traits\ApiResponse;
use Exception;

class FileStorageException extends Exception
{
    use ApiResponse;
     public function __construct(string $message = "فشل في تخزين الملف")
    {
        $this->message = $message;
    }

    public function render()
    {
        return $this->error($this->message);        
    }
}
