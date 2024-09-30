<?php

namespace App\Services\Lucky;

use App\Models\User;
use App\Services\Lucky\Contracts\LuckyPageTokenServiceInterface;
use DateTimeInterface;
use Laravel\Sanctum\NewAccessToken;

class LuckyPageTokenService implements LuckyPageTokenServiceInterface
{
    const DEFAULT_LUCKY_PAGE_TOKEN_NAME = 'lucky-page-token';

    public function createNewAccessToken(User $user): NewAccessToken
    {
        return $user->createToken(name: static::DEFAULT_LUCKY_PAGE_TOKEN_NAME, expiresAt: $this->getExpirationTime());
    }

    protected function getExpirationTime(): DateTimeInterface
    {
        return now()->addMinutes((int) config('sanctum.expiration'));
    }
}