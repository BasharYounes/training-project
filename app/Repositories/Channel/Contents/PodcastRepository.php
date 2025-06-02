<?php 

namespace App\Repositories\Channel\Contents;

use App\Exceptions\Content\Podcast\PodcastRegistrationException;
use App\Models\Podcast;

class PodcastRepository
{
    public function createPodcast(Array $data)
    {
        $podcast = Podcast::create($data);

        if(!$podcast)
            {
                throw new PodcastRegistrationException();
            }

        return $podcast;
    }

    public function findPodcast($id)
    {
        $podcast = Podcast::where('id',$id)->firstOrFail();

        return $podcast;
    }
    
}