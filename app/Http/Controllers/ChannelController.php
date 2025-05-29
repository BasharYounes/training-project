<?php

namespace App\Http\Controllers;

use App\Http\Requests\storechannelRequest;
use App\Models\Channel;
use App\Repositories\Channel\ChannelRepository;
use App\Services\ChannelService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    use ApiResponse;

    public function __construct(protected ChannelRepository $channelRepository)
    {}
       public function store(storechannelRequest $request)
    {
        $this->channelRepository->createChannel($request->validated());

        return $this->success('تمت العملية بنجاح');
    }
}
