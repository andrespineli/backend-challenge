<?php

namespace App\Ecommerce\V1\Infrastructure\Repositories;

use App\Ecommerce\V1\Infrastructure\Repositories\Repository;

abstract class EloquentRepository implements Repository
{
    public function create(array $customer) : array
    {
        return $this->entity
                    ->create($customer)                   
                    ->toArray();
    }

    public function update(array $data) : array
    {
        $customer = $this->entity->find($data['id']);  
        $customer->update($data);        
        return $this->findById($data['id']);
    }

    public function all() : array
    {
       return $this->entity
                   ->all()
                   ->toArray();
    }

    public function findById(int $id) : array
    {
        return $this->entity
                    ->findOrFail($id)
                    ->toArray();
    }
}