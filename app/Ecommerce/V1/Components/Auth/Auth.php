<?php

namespace App\Ecommerce\V1\Components\Auth;

use App\Ecommerce\V1\Components\Auth\AuthComponent;
use App\Ecommerce\V1\Components\Customer\CustomerComponent;

class Auth implements AuthComponent
{  
    private $customerComponent;
    
    public function __construct(CustomerComponent $customerComponent)
    {
        $this->customerComponent = $customerComponent;
    }

    public function login(array $login)
    {
        $customer = $this->customerComponent->getCustomerByEmailAndPass($login['email'], $login['password']);

        $token = $this->generateToken();
        $auth = $this->customerComponent->setAuthToken($customer->id, $token);

        if (!$auth) {
            return ['error' => 'Authentication failure.'];
        }

        return ['api_token' => $token];
    }

    public function generateToken()
	{
        $first = sha1(str_random(64));
        $second = sha1(str_random(64));
		return "{$first}.{$second}";
	}
}