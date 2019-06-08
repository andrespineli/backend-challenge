<?php

namespace App\Ecommerce\V1\Components\Auth;

interface AuthComponent
{
    public function generateToken() : string;
    public function login(array $login) : array;
    public function getAuthEntity() : array;
}