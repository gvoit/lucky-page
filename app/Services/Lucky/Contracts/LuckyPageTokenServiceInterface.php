<?php

namespace App\Services\Lucky\Contracts;

use App\Models\User;
use Laravel\Sanctum\NewAccessToken;

interface LuckyPageTokenServiceInterface 
{
    public function createNewAccessToken(User $user): NewAccessToken;

}