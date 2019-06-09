<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Ecommerce\V1\Infrastructure\Models\Customer;

class AuthTest extends TestCase
{
    use DatabaseMigrations;

    public function testItCanLogin()
    {
        $customer = factory(Customer::class)->create()
            ->makeVisible('password')
            ->toArray();

        $this->json('POST', '/api/v1/login', $customer)
            ->assertStatus(200)
            ->assertJsonStructure([
                'api_token'
            ]);
    }
}
