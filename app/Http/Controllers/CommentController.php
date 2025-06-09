<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Resources\CommentResource;
use App\Models\Podcast;
use App\Repositories\Channel\Contents\PodcastRepository;
use App\Resources\PodcastResource;
use App\Services\CommentService;
use App\Traits\ApiResponse;

class CommentController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected CommentService $commentService,
        protected PodcastRepository $podcastRepository,
    ) 
    {}
    public function store(StoreCommentRequest $request,  $id)
    {
        $podcast = $this->podcastRepository->findPodcast($id);

        $comment = $this->commentService->createComment(
            user: auth()->user(),
            commentable: $podcast,
            data: $request->validated(),
        );

        return $this->success('تمت العنلية بنجاح',$comment,201);
    }

    public function getCommentsWithReplies($id)
    {
        $podcast = $this->podcastRepository->findPodcast($id);

        $comments = $this->commentService->getNestedComments($podcast);
        return $this->success('تمت العنلية بنجاح',CommentResource::collection($comments),200);
    }

    public function showCommentsPodcast($id)
    {
        $podcast = Podcast::with([
            'comments.user',                  
            'comments.replies.user',           
            'comments.replies.replies.user',  
        ])->findOrFail($id);

        return $this->success('تمت العنلية بنجاح',PodcastResource::collection($podcast),200) ;
    }
}
