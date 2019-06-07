<?php

namespace App\Ecommerce\V1\Components\Auth;

interface AuthComponent
{
    public function generateToken();
    public function login(array $login);
}