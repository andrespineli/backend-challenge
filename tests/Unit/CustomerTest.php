<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Ecommerce\V1\Infrastructure\Models\Customer;

class CustomerTest extends TestCase
{
    use DatabaseMigrations;

    private $entity;
    private $customerComponent;
    private $authComponent;

    public function setUp()
    {
        parent::setUp();
        $this->entity = Customer::class;
        $this->customerComponent = $this->app->make('App\Ecommerce\V1\Components\Customer\CustomerComponent');
        $this->authComponent = $this->app->make('App\Ecommerce\V1\Components\Auth\AuthComponent');
    }

    public function testItCanCreateNewCustomer()
    {
        $mock = factory($this->entity)->make()
            ->makeVisible('password')
            ->toArray();

        $customer = $this->customerComponent->newCustomer($mock);
        $this->assertArraySubset($mock, $customer);
    }

    public function testItCanGetAllCustomers()
    {
        $mock = factory($this->entity, 5)->create()
            ->toArray();

        $customers = $this->customerComponent->getCustomers();
        $this->assertArraySubset($mock, $customers);
    }

    public function testItCanGetCustomerByEmailAndPass()
    {
        $mock = factory($this->entity)->create()
            ->toArray();

        $customer = $this->customerComponent->getCustomerByEmail($mock['email']);

        unset($mock['password']);

        $this->assertArraySubset($mock, $customer);
    }

    public function testItCanGetCustomerByCpf()
    {
        $mock = factory($this->entity)->create()
            ->toArray();

        $customer = $this->customerComponent->getCustmerByCpf($mock['cpf']);

        $this->assertArraySubset($mock, $customer);
    }

    public function testItCanSetCustomerAuthToken()
    {
        $mock = factory($this->entity)->create()
            ->toArray();

        $token = $this->authComponent->generateToken();
        $customer = $this->customerComponent->setAuthToken($mock['id'], $token);

        $this->assertEquals($customer['api_token'], $token);
    }
}
