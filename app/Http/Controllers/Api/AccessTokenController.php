<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Lucky\Contracts\LuckyPageTokenServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccessTokenController extends Controller
{
    public function __construct(protected LuckyPageTokenServiceInterface $luckyPageTokenService)
    {
        
    }
    public function store(Request $request): JsonResponse
    {
        $newAccessToken = $this->luckyPageTokenService->createNewAccessToken($request->user());

        return response()->json([
            'token' => $newAccessToken->plainTextToken
        ],);
    }

    public function destroy(Request $request): Response
    {
        $request->user()->currentAccessToken()->delete();

        return response()->noContent();
    }
}
