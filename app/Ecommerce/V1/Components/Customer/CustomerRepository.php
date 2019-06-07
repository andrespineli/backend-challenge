<?php

namespace App\Ecommerce\V1\Components\Customer;

interface CustomerRepository
{
    public function findByEmail($email) : object;    
}