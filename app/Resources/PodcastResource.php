<?php

namespace App\Resources;

use App\Resources\CommentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PodcastResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         return [
            'id' => $this->id,
            'episode_number' => $this->episode_number,
            'duration' => $this->duration,
            'comments' => CommentResource::collection($this->comments),
        ];;
    }
}
