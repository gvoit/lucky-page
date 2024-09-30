<?php

declare(strict_types=1);

namespace App\Services\Lucky;

use App\Models\FeelingLuckyResult;
use App\Models\User;
use App\Services\Lucky\Contracts\LuckyServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class LuckyService implements LuckyServiceInterface
{
    protected static int $historyLimit = 3;
    protected static int $randomRangeFrom = 1;
    protected static int $randomRangeTo = 1000;


    public function imFeelingLucky(User $user): FeelingLuckyResult 
    {
        $randomNumber = $this->getRandomNumber();
        $feelingLuckyResult = FeelingLuckyResult::make();
        $feelingLuckyResult->user_id = $user->id;
        $feelingLuckyResult->random_number = $randomNumber;

        $feelingLuckyResult->is_winner = $this->checkIfWinnerNumber($randomNumber);

        $feelingLuckyResult->prize = 0;

        if ($feelingLuckyResult->is_winner) {
            $feelingLuckyResult->prize = $this->givePrize($randomNumber);
        }
    
        $feelingLuckyResult->save();

        return $feelingLuckyResult;
    }

    public function history(User $user): Collection 
    {
        return FeelingLuckyResult::forUser($user)->orderByDesc('created_at')->limit(static::$historyLimit)->get();
    }

    protected function getRandomNumber(): int
    {
        return rand(static::$randomRangeFrom, static::$randomRangeTo);
    }


    protected function checkIfWinnerNumber(int $randomNumber): bool
    {
        return $randomNumber % 2 === 0; 
    }

    protected function givePrize(int $randomNumber): int
    {
        if ($randomNumber > 900) {
            return (int) round($randomNumber * 0.7);
        }

        if ($randomNumber > 600) {
            return (int) round($randomNumber * 0.5);
        }

        if ($randomNumber > 300) {
            return (int) round($randomNumber * 0.3);
        }

        return (int) round($randomNumber * 0.1); 
    }
    
}