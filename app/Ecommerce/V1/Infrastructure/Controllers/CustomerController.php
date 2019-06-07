<?php

namespace App\Ecommerce\V1\Infrastructure\Controllers;

use App\Ecommerce\V1\Infrastructure\Controllers\Controller;
use App\Ecommerce\V1\Infrastructure\Requests\CustomerNew;
use App\Ecommerce\V1\Infrastructure\Requests\CustomerLogIn;
use App\Ecommerce\V1\Components\Customer\CustomerComponent;
use App\Ecommerce\V1\Components\Auth\AuthComponent;

class CustomerController extends Controller
{
    private $customer;
    private $auth;

    public function __construct(CustomerComponent $customer, AuthComponent $auth) 
    {
        $this->customer = $customer;
        $this->auth = $auth;
    }

    public function new(CustomerNew $customer)
    {
        $customer = $customer->validated();
        $new = $this->customer->newCustomer($customer); 
        $login['email'] = $new->email;
        $login['password'] = $new->password;
        return $this->auth->logIn($login);       
    } 

    public function get()
    {
        return $this->customer->getCustomers();
    }
  
}
