<?php

namespace App\Ecommerce\V1\Components\Customer;

use App\Ecommerce\V1\Components\Customer\CustomerComponent;
use App\Ecommerce\V1\Components\Customer\CustomerRepository;

class Customer implements CustomerComponent
{
    private $repository;

    public function __construct(CustomerRepository $repository) {
        $this->repository = $repository;
    }

    public function newCustomer($customer)
    {
        return $this->repository->create($customer);
    }

    public function updateCustomer()
    { }

    public function getCustomers()
    {
        return $this->repository->all();
    }

    public function getCustomerByEmailAndPass($email, $pass)
    {
        return $this->repository->findByEmail($email);            
    }

    public function setAuthToken($customerId, $token)
    {
        $customer = $this->repository->findById($customerId);
        $data['id'] = $customer->id;
        $data['api_token'] = $token;
        return $this->repository->update($data);
    }
}
