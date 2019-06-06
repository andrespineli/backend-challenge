<?php

namespace App\Ecommerce\V1\Components\Customer;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Ecommerce\V1\Components\Customer\CustomerRepository;
use App\Ecommerce\V1\Infrastructure\Models\Customer;

class EloquentCustomerRepository implements CustomerRepository
{
    private $entity;

    public function __construct(Customer $entity)
    {
        $this->entity = $entity;
    }

    public function create($customer) : Array
    {
        return $this->entity->create($customer);
    }

    public function update($data) : Array
    {
        $customer = $this->entity->find($data['id']);       
        $customer->update($data);
        return $this->findById($data['id']);
    }

    public function getAll() : Array
    {
       return $this->entity->all()->toArray();
    }

    public function findById($id) : Array
    {
        return $this->entity->find($id)->toArray();
    }

    public function findByEmail($email) : Array
    {
        try {
            $entity = $this->entity
                           ->where('email', '=', $email)
                           ->firstOrFail()
                           ->toArray();
            
            return [
                'error' => false,
                'data' => $entity               
            ];
        } catch (ModelNotFoundException $ex) {
            return [
                'error' => true,
                'message' => 'E-mail not found.'               
            ];
        }
        
    }

    public function getPassByEmail($email)
    {
        return $this->entity
                    ->where('email', '=', $email)
                    ->first()
                    ->password;
        }
}