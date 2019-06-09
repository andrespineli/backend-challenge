<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Ecommerce\V1\Infrastructure\Models\Customer;

class AuthTest extends TestCase
{
    use DatabaseMigrations;

    private $entity;
    private $authComponent; 
    
    public function setUp() {
        parent::setUp();
        $this->entity = Customer::class;  
        $this->authComponent = $this->app->make('App\Ecommerce\V1\Components\Auth\AuthComponent');
    }

    public function test_it_can_generate_auth_token()
    {
        $token = $this->authComponent->generateToken();       
        $this->assertNotEmpty($token);    
    }

    public function test_it_can_login()
    {
        $customer = factory($this->entity)->create()   
                                          ->makeVisible('password')                                         
                                          ->toArray(); 

        $login = $this->authComponent->login($customer);
        $this->assertArrayHasKey('api_token', $login); 
        $this->assertNotEmpty($login['api_token']);                 
    }

    public function test_it_can_get_auth_entity()
    {
        $customer = factory($this->entity)->create();
        $this->be($customer);
        $entity = $this->authComponent->getAuthEntity();             
        $this->assertEquals($customer->toArray(), $entity);    
    }
}