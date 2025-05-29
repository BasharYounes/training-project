<?php 

namespace App\Repositories\Channel\Contents;

use App\Exceptions\Content\Podcast\PodcastRegistrationException;
use App\Models\Podcast;

class PodcastRepository
{
    public function createPodcast(Array $data)
    {
        $podcast = new Podcast([$data]);

        if(!$podcast)
            {
                throw new PodcastRegistrationException();
            }

        return $podcast;
    }
}