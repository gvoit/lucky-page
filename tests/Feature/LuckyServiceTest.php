<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\Lucky\LuckyService;
use Mockery;
use Tests\TestCase;

class LuckyServiceTest extends TestCase
{
    /**
     * @dataProvider imFeelingLuckyDataProvide
     */
    public function test_imFeelingLucky(int $randomNumber, bool $isWinner, int $expectedPrize): void
    {
        $user = User::factory()->create();

        /** @var LuckyService $serviceMock*/
        $serviceMock = Mockery::mock(LuckyService::class)
            ->shouldAllowMockingProtectedMethods()
            ->makePartial()
            ->shouldReceive('getRandomNumber')
            ->andReturn($randomNumber)
            ->getMock();
        
        $feelingLuckyResult = $serviceMock->imFeelingLucky($user);

        $this->assertEquals($randomNumber, $feelingLuckyResult->random_number);
        $this->assertEquals($isWinner, $feelingLuckyResult->is_winner);
        $this->assertEquals($expectedPrize, $feelingLuckyResult->prize);

           
    }

    public static function imFeelingLuckyDataProvide(): array
    {
        return [
            '902 winner prize 70%' => [
                'randomNumber' => 902, 
                'isWinner' => true, 
                'expectedPrize' => 631, 
            ],

            '901 loose prize 0' => [
                'randomNumber' => 901, 
                'isWinner' => false, 
                'expectedPrize' => 0, 
            ],

            '900 winner prize 50%' => [
                'randomNumber' => 900, 
                'isWinner' => true, 
                'expectedPrize' => 450, 
            ],

            '602 winner prize 50%' => [
                'randomNumber' => 602, 
                'isWinner' => true, 
                'expectedPrize' => 301, 
            ],

            '601 loose prize 0' => [
                'randomNumber' => 601, 
                'isWinner' => false, 
                'expectedPrize' => 0, 
            ],

            '600 winner prize 30%' => [
                'randomNumber' => 600, 
                'isWinner' => true, 
                'expectedPrize' => 180, 
            ],

            '302 winner prize 30%' => [
                'randomNumber' => 302, 
                'isWinner' => true, 
                'expectedPrize' => 91, 
            ],

            '301 loose prize 0' => [
                'randomNumber' => 301, 
                'isWinner' => false, 
                'expectedPrize' => 0, 
            ],

            '300 winner prize 10%' => [
                'randomNumber' => 300, 
                'isWinner' => true, 
                'expectedPrize' => 30, 
            ],

            '209 winner prize 10%' => [
                'randomNumber' => 209, 
                'isWinner' => false, 
                'expectedPrize' => 0, 
            ],

            '2 winner prize 10%' => [
                'randomNumber' => 2, 
                'isWinner' => true, 
                'expectedPrize' => 0, 
            ],

            '1 winner prize 10%' => [
                'randomNumber' => 1, 
                'isWinner' => false, 
                'expectedPrize' => 0, 
            ],

        ];
    }
}
