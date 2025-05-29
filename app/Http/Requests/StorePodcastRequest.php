<?php 


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePodcastRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'audio' => 'required|file|mimes:mp3,wav,aac|max:102400', // 100MB
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'episode_number' => 'required|integer',
            'duration' => 'required|integer|min:1',
            'published_at' => 'nullable|date'
        ];
    }
}