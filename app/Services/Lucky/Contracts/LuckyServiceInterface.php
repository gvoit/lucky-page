<?php

namespace App\Services\Lucky\Contracts;

use App\Models\FeelingLuckyResult;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface LuckyServiceInterface 
{
    public function imFeelingLucky(User $user): FeelingLuckyResult;

    public function history(User $user): Collection;
}