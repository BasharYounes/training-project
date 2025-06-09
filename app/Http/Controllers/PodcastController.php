<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class PodcastController extends Controller
{
    use ApiResponse;
    public function random(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $podcasts = Podcast::with('categories', 'content')
            ->inRandomOrder()
            ->paginate($perPage);

        return $this->success('Podcasts is :',$podcasts,200);
    }
}
