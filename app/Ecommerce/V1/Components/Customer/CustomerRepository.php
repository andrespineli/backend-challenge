<?php

namespace App\Ecommerce\V1\Components\Customer;

interface CustomerRepository
{
    public function create($customer) : Array;
    public function update($customer) : Array;
    public function getAll() : Array;
    public function findByEmail($email) : Array;
}