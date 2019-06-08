<?php

namespace App\Ecommerce\V1\Components\Auth;

use App\Ecommerce\V1\Components\Auth\AuthComponent;
use App\Ecommerce\V1\Components\Auth\AuthRepository;
use App\Ecommerce\V1\Components\Customer\CustomerComponent;

class Auth implements AuthComponent
{  
    private $repository;
    private $customerComponent;
    
    public function __construct(CustomerComponent $customerComponent, AuthRepository $repository)
    {
        $this->customerComponent = $customerComponent;
        $this->repository = $repository;
    }

    public function login(array $login) : array
    {
        $customer = $this->customerComponent->getCustomerByEmailAndPass($login['email'], $login['password']);
       
        $token = $this->generateToken();
        $auth = $this->customerComponent->setAuthToken($customer['id'], $token);

        if (!$auth) {
            return ['error' => 'Authentication failure.'];
        }

        return ['api_token' => $auth['api_token']];
    }

    public function generateToken() : string
	{
        $first = sha1(str_random(64));
        $second = sha1(str_random(64));
		return "{$first}.{$second}";
    }
    
    public function getAuthEntity() : array
    {
        return $this->repository->getAuthEntity();
    }
}