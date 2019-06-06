<?php

namespace App\Ecommerce\V1\Components\Customer;

use App\Ecommerce\V1\Components\Customer\CustomerComponent;
use App\Ecommerce\V1\Components\Auth\AuthComponent;
use App\Ecommerce\V1\Components\Customer\CustomerRepository;

class Customer implements CustomerComponent
{
    private $repository;
    private $authComponent;

    public function __construct(
        CustomerRepository $repository,
        AuthComponent $authComponent
    ) {
        $this->repository = $repository;
        $this->authComponent = $authComponent;
    }

    public function newCustomer($customer)
    {
        $customer['api_token'] = $this->authComponent->generateToken();            
        return $this->repository->createCustomer($customer);
    }

    public function updateCustomer()
    { 

    }

    public function getCustomers()
    {
        return $this->repository->getAll();
    }

    public function logIn($login)
    {
        try {
            $customer = $this->repository->findByEmail($login['email']);                            

            if ($customer['error']) {
                throw new \Exception($customer['message'], 1);                
            }

            $password = $this->repository->getPassByEmail($login['email']);    

            if ($password != $login['password']) {
                throw new \Exception("Incorrect password.", 2);  
            }

            $customer['data']['api_token'] = $this->authComponent->generateToken();             
            
            $this->repository->update($customer['data']);

            return [
                'api_token' => $customer['data']['api_token']
            ];

        } catch (\Throwable $th) {
            return [
                'errors' => $th->getMessage(),
                'code' => $th->getCode()
            ];
        }
    }
}
