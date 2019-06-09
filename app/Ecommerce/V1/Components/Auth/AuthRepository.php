<?php

namespace App\Ecommerce\V1\Components\Auth;

interface AuthRepository
{
    public function getAuthEntity(): array;
}
