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

    public function storePodacstLike($podcast,$user)
    {
        $podcast->likes()->create([
            'user_id' => $user->id,
        ]);
        return $podcast->likes();
    }

    public function deletePodacstLike($podcast,$user)
    {
        $podcast->likes()->where('user_id', $user->id)->delete();
    }
    
}