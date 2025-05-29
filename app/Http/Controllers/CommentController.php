<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Podcast;
use App\Services\CommentService;
use App\Traits\ApiResponse;

class CommentController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected CommentService $commentService,
    ) 
    {}
    public function store(StoreCommentRequest $request, Podcast $podcast)
    {
        $comment = $this->commentService->createComment(
            user: auth()->user(),
            commentable: $podcast,
            data: $request->validated(),
            parentId: $request->input('parent_id') 
        );

        return $this->success('تمت العنلية بنجاح',$comment,201);
    }

    public function index(Podcast $podcast)
    {
        $comments = $this->commentService->getNestedComments($podcast);
        return $this->success('تمت العنلية بنجاح',CommentResource::collection($comments),200);
    }
}
