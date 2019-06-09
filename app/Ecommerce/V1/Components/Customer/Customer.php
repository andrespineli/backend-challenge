<?php

namespace App\Ecommerce\V1\Components\Customer;

use App\Ecommerce\V1\Components\Customer\CustomerComponent;
use App\Ecommerce\V1\Components\Customer\CustomerRepository;

class Customer implements CustomerComponent
{
    private $repository;

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function newCustomer(array $customer): array
    {
        return $this->repository->create($customer);
    }

    public function getCustomers(): array
    {
        return $this->repository->all();
    }

    public function getCustomerByEmailAndPass(string $email, string $pass): array
    {
        return $this->repository->findByEmail($email);
    }

    public function getCustmerByCpf(string $cpf): array
    {
        return $this->repository->findByCpf($cpf);
    }

    public function setAuthToken(int $customerId, string $token): array
    {
        $customer = $this->repository->findById($customerId);
        $data['id'] = $customer['id'];
        $data['api_token'] = $token;
        return $this->repository->update($data);
    }
}
