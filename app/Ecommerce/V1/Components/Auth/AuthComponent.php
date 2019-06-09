<?php

namespace App\Ecommerce\V1\Components\Auth;

interface AuthComponent
{
    public function generateToken(): string;
    public function login(array $login): array;
    public function getAuthEntity(): array;
    public function hashPassword(string $password): string;
    public function verifyEmailAndPass(string $email, string $pass): array;
}
