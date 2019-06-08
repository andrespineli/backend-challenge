<?php

namespace App\Ecommerce\V1\Components\Customer;

use App\Ecommerce\V1\Infrastructure\Repositories\EloquentRepository;
use App\Ecommerce\V1\Components\Customer\CustomerRepository;
use App\Ecommerce\V1\Infrastructure\Models\Customer;

class EloquentCustomerRepository extends EloquentRepository implements CustomerRepository
{
    protected $entity;

    public function __construct(Customer $entity)
    {
        $this->entity = $entity;
    }

    public function create(array $customer) : array
    {
        return $this->entity
                    ->create($customer)
                    ->makeVisible('password')
                    ->toArray();
    }

    public function findByEmail(string $email) : array
    {
        return $this->entity
                    ->where('email', '=', $email)
                    ->firstOrFail()
                    ->toArray();            
    }   

    public function findByCpf(string $cpf) : array
    {
        return $this->entity
                    ->where('cpf', '=', $cpf)
                    ->firstOrFail()
                    ->toArray();            
    }   
}