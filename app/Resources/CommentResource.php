<?php 

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'user' => new UserResource($this->user),
            'created_at' => $this->created_at,
            'replies' => CommentResource::collection($this->whenLoaded('replies')),
        ];
    }
}