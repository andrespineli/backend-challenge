<?php

namespace App\Ecommerce\V1\Infrastructure\Repositories;

use App\Ecommerce\V1\Infrastructure\Repositories\Repository;

abstract class EloquentRepository implements Repository
{
    public function create($customer) : object
    {
        return $this->entity->create($customer);
    }

    public function update($data) : object
    {
        $customer = $this->entity->find($data['id']);       
        $customer->update($data);
        return $this->findById($data['id']);
    }

    public function all() : object
    {
       return $this->entity->all();
    }

    public function findById($id) : object
    {
        return $this->entity->find($id)->firstOrFail();
    }
}