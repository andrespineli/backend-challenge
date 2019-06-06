<?php

namespace App\Ecommerce\V1\Infrastructure\Controllers;

use App\Ecommerce\V1\Infrastructure\Controllers\Controller;
use App\Ecommerce\V1\Infrastructure\Requests\CustomerNew;
use App\Ecommerce\V1\Infrastructure\Requests\CustomerLogIn;
use App\Ecommerce\V1\Components\Customer\CustomerComponent;

class CustomerController extends Controller
{
    private $customer;

    public function __construct(CustomerComponent $customer) 
    {
        $this->customer = $customer;
    }

    public function new(CustomerNew $customer)
    {
        $customer = $customer->validated();
        return $this->customer->newCustomer($customer);
    }

    public function get()
    {
        return $this->customer->getCustomers();
    }

    public function logIn(CustomerLogIn $login)
    {
        $login = $login->validated();
        return $this->customer->logIn($login);
    }
}
