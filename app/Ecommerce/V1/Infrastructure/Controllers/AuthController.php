<?php

namespace App\Ecommerce\V1\Infrastructure\Controllers;

use App\Ecommerce\V1\Infrastructure\Controllers\Controller;
use App\Ecommerce\V1\Infrastructure\Requests\AuthLogIn;
use App\Ecommerce\V1\Components\Auth\AuthComponent;

class AuthController extends Controller
{
    private $authComponent;

    public function __construct(AuthComponent $authComponent)
    {
        $this->authComponent = $authComponent;
    }

    public function logIn(AuthLogIn $login)
    {
        $login = $login->validated();
        return $this->authComponent->logIn($login);
    }
}
