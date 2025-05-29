<?php 

namespace App\Services;

use App\Models\User;
use App\Repositories\CommentRepository;
use DB;
use Illuminate\Database\Eloquent\Model;

class CommentService 
{
    public function __construct(
        protected CommentRepository $commentRepository,
    )
    {}

    public function createComment(User $user, Model $commentable, array $data, ?int $parentId = null)
    {
        return DB::transaction(function () use ($user, $commentable, $data, $parentId) {
            $data['user_id'] = $user->id;
            $data['parent_id'] = $parentId;
            $comment = $this->commentRepository->create([$data]);

            $comment->commentable()->associate($commentable);
            $comment->save();

            return $comment->load('user', 'replies');
        });
    }

    public function getNestedComments(Model $commentable)
    {
        return $this->commentRepository->getThreadedComments($commentable);
    }
}
