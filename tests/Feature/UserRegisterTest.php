<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRegisterTest extends TestCase
{
    use WithFaker, DatabaseTransactions;

    
    public function test_registration(): void
    {
        $userData = [
            'username' => $this->faker()->userName(),
            'phone_number' => $this->faker()->phoneNumber(),
        ];

        $response = $this->post(route('api.user.register'), $userData);

        $response->assertCreated()
            ->assertJsonStructure(['token']);
    }
}
