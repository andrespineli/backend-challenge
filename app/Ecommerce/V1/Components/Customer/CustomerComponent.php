<?php

namespace App\Ecommerce\V1\Components\Customer;

interface CustomerComponent
{
    public function newCustomer($request);
    public function updateCustomer();
    public function getCustomers();
}