<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAudiobookRequest;
use App\Http\Requests\StorePodcastRequest;
use App\Http\Resources\PodcastResource;
use App\Models\Audiobook;
use App\Models\Channel;
use App\Models\Content;
use App\Models\Podcast;
use App\Repositories\Channel\ChannelRepository;
use App\Repositories\Channel\Contents\AudiobookRepository;
use App\Repositories\Channel\Contents\PodcastRepository;
use App\Traits\ApiResponse;
use DB;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\Channel\ChannelService;


class ContentController extends Controller
{
    use ApiResponse,AuthorizesRequests;

    public function __construct(protected ChannelService $channelService,
    protected ChannelRepository $channelRepository,
    protected PodcastRepository $podcastRepository,
    protected AudiobookRepository $audiobookRepository
    )
    {}

     public function storePodcast(StorePodcastRequest $request,$id): JsonResponse
    {
        $channel = $this->channelRepository->findChannel($id);
   
        if(!$this->authorize('create', $channel))
        {
            throw new AuthorizationException();
        }

         DB::transaction(function () use ($request, $channel) {

            $audioPath = $this->channelService->storeAudio(
            $request->file('audio'),
            'podcasts/audio',
            );

            $coverPath = $this->channelService->storeCover(
                $request->file('cover_image'),
                'podcasts/covers',
            );
            

            $Objcontent = $this->channelRepository->
            createObjectContent($request->validated(),$audioPath,$coverPath);;
            
            $podcast = $this->podcastRepository->createPodcast($request->validated());

            $content =  $this->channelRepository->createAndSaveContent($Objcontent,$channel,$podcast);

            return $content->load('contentable');
        });

        return $this->success('تمت العملية بنجاح');
    }

    public function storeAudiobook(StoreAudiobookRequest $request,$id): JsonResponse
    {

        $channel = $this->channelRepository->findChannel($id);
   
        $this->authorize('create', $channel);


        DB::transaction(function () use ($request, $channel) {

            
            $audioPath = $this->channelService->storeAudio(
                $request->file('audio'),
                'audiobook/audio',
            );

            $coverPath = $this->channelService->storeCover(
                $request->file('cover_image'),
                'audiobook/covers',
            );
            

            $Objcontent = $this->channelRepository->
            createObjectContent($request->validated(),$audioPath,$coverPath);;
            
            $audiobook = $this->audiobookRepository->createAudiobook($request->validated());

            $content =  $this->channelRepository->createAndSaveContent($Objcontent,$channel,$audiobook);

            return $content->load('contentable');
        });

        return $this->success('تمت العملية بنجاح');
    }
}

