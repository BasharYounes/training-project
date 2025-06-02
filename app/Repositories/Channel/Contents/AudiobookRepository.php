<?php 

namespace App\Repositories\Channel\Contents;

use App\Exceptions\Content\Audiobook\AudioRegistrationException;
use App\Models\Audiobook;

class AudiobookRepository
{
      public function createAudiobook(Array $data)
    {
        $audiobook = Audiobook::create($data);

         if(!$audiobook)
            {
                throw new AudioRegistrationException();
            }

        return $audiobook;
    }
}