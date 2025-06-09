<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use App\Repositories\Channel\Contents\PodcastRepository;
use App\Traits\ApiResponse;
use Request;

class PodcastLikeController extends Controller
{
    use ApiResponse;

    public function __construct(protected PodcastRepository $podcastRepository)
    {}
    
    public function store($id)
    {
        $podcast = $this->podcastRepository->findPodcast($id);

        $user = auth()->user();

        if ($podcast->isLikedBy($user))
        {
            return $this->error('Already liked',null, 409);
        }

        $this->podcastRepository->storePodacstLike($podcast,$user);


        return $this->success( 'Liked success',null, 201);
    }

    public function destroy($id)
    {
        $podcast = $this->podcastRepository->findPodcast($id);

        $user = auth()->user();

        $this->podcastRepository->deletePodacstLike($podcast,$user);

        return $this->success( 'Unliked',null, 200);
    }

    
}
