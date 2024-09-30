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
            'winner prize 70%' => [
                'randomNumber' => 902, 
                'isWinner' => true, 
                'expectedPrize' => 631, 
            ],
            'winner prize 10%' => [
                'randomNumber' => 200, 
                'isWinner' => true, 
                'expectedPrize' => 20, 
            ]
        ];
    }
}
