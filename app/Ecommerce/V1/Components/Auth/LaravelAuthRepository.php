<?php

namespace App\Ecommerce\V1\Components\Auth;

use App\Ecommerce\V1\Components\Auth\AuthRepository;
use Illuminate\Support\Facades\Auth;

class LaravelAuthRepository implements AuthRepository
{
    protected $entity;

    public function getAuthEntity(): array
    {
        return Auth::user()->toArray();
    }
}
