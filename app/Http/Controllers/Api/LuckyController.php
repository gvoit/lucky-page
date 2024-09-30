<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FeelingLuckyResultResource;
use App\Services\Lucky\Contracts\LuckyServiceInterface;
use Illuminate\Http\Request;

class LuckyController extends Controller
{
    public function __construct(protected LuckyServiceInterface $luckyService)
    {
    }

    public function history(Request $request)
    {
        return FeelingLuckyResultResource::collection($this->luckyService->history($request->user()));
    }

    public function store(Request $request): FeelingLuckyResultResource
    {
        return FeelingLuckyResultResource::make($this->luckyService->imFeelingLucky($request->user()));
    }

    
}
