<?php 

namespace App\Repositories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class CommentRepository
{
    public function create(array $data): Comment
    {
        return new Comment($data);  
    }
    
    // public function getThreadedComments($commentable){
    //     return $commentable->comments()->with('user', 'replies')->get()->toTree();
    // }

    public function getThreadedComments(Model $commentable)
    {
        return Comment::with(['user', 'replies.user'])
            ->where('commentable_id', $commentable->id)
            ->where('commentable_type', get_class($commentable))
            ->whereNull('parent_id')
            ->get();
    }
}