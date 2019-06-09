<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Ecommerce\V1\Infrastructure\Models\Customer;

class CustomerTest extends TestCase
{
    use DatabaseMigrations;

    public function testItCanCreateNewCustomer()
    {
        $customer = factory(Customer::class)->make()
            ->makeVisible('password')->toArray();

        $this->json('POST', '/api/v1/customers', $customer)
            ->assertStatus(200)
            ->assertJsonStructure([
                'api_token'
            ]);
    }

    public function testItCanGetAllCustomers()
    {
        $authCustomer = factory(Customer::class)->make();
        factory(Customer::class, 5)->create()
            ->toArray();

        $this->actingAs($authCustomer)
            ->json('GET', '/api/v1/customers')
            ->assertStatus(200)
            ->assertJsonStructure([
                0 => [
                    'id',
                    'name',
                    'cpf',
                    'email'
                ]
            ]);
    }
}
