<?php

namespace App\Ecommerce\V1\Components\Auth;

interface AuthRepository
{
    public function getAuthEntity(): array;
    public function hashPassword(string $password): string;
    public function verifyHashPassword(string $password, string $hashedPass): bool;
}
