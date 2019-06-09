<?php

namespace App\Ecommerce\V1\Components\Auth;

use App\Ecommerce\V1\Components\Auth\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LaravelAuthRepository implements AuthRepository
{
    protected $entity;

    public function getAuthEntity(): array
    {
        return Auth::user()->toArray();
    }

    public function hashPassword($password): string
    {
        return Hash::make($password);
    }

    public function verifyHashPassword($password, $hashedPass): bool
    {
        return Hash::check($password, $hashedPass);
    }
}
