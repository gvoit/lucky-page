<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Services\Lucky\Contracts\LuckyPageTokenServiceInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class UserRegisterController extends Controller
{

    public function __invoke(RegisterUserRequest $request, LuckyPageTokenServiceInterface $luckyPageTokenService): JsonResponse
    {
        DB::beginTransaction();
       
        try {
            $userData = $request->validated();
            $user = User::create($userData);
            $newAccessToken = $luckyPageTokenService->createNewAccessToken($user);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            
            throw $e;
        }

        return response()->json([
            'token' => $newAccessToken->plainTextToken
        ], Response::HTTP_CREATED);
    }
}
