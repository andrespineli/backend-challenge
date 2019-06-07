<?php

namespace App\Ecommerce\V1\Components\Customer;

interface CustomerRepository
{
    public function create($customer) : object;
    public function update($customer) : object;
    public function getAll() : object;
    public function findByEmail($email) : object;
    public function findById($id) : object;
}