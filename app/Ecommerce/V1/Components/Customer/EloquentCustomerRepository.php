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

    public function findByEmail($email) : object
    {
        return $this->entity
                    ->where('email', '=', $email)
                    ->firstOrFail();            
    }   
}