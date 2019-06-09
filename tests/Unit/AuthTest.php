<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Ecommerce\V1\Infrastructure\Models\Customer;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{
    use DatabaseMigrations;

    private $entity;
    private $authComponent;

    public function setUp()
    {
        parent::setUp();
        $this->entity = Customer::class;
        $this->authComponent = $this->app->make('App\Ecommerce\V1\Components\Auth\AuthComponent');
    }

    public function testItCanGenerateAuthToken()
    {
        $token = $this->authComponent->generateToken();
        $this->assertNotEmpty($token);
    }

    public function testItCanLogin()
    {
        $customer = factory($this->entity)->create()
            ->toArray();

        $login = $this->authComponent->login($customer);
        $this->assertArrayHasKey('api_token', $login);
        $this->assertNotEmpty($login['api_token']);
    }

    public function testItCanGetAuthEntity()
    {
        $customer = factory($this->entity)->create();
        $this->be($customer);
        $entity = $this->authComponent->getAuthEntity();
        $this->assertEquals($customer->toArray(), $entity);
    }

    public function testItCanHashPassword()
    {
        $hashedPassword = $this->authComponent->hashPassword('123456');
        $this->assertNotEmpty($hashedPassword);
    }

    public function testItCanVerifyEmailAndPass()
    {
        $customer = factory($this->entity)->create()
            ->toArray();

        $verified = $this->authComponent->verifyEmailAndPass($customer['email'], '123456');

        $this->assertTrue($verified['email']);
        $this->assertTrue($verified['password']);
    }

    public function testItCannotVerifyEmail()
    {
        $verified = $this->authComponent->verifyEmailAndPass('incorrect@email.com', '000000');
        $this->assertFalse($verified['email']);
    }

    public function testItCannotVerifyPassword()
    {
        $customer = factory($this->entity)->create()
            ->toArray();

        $verified = $this->authComponent->verifyEmailAndPass($customer['email'], '000000');
        $this->assertFalse($verified['password']);
    }
}
