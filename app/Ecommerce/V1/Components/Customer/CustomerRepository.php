<?php

namespace App\Ecommerce\V1\Components\Customer;

interface CustomerRepository
{
    public function findByEmail(string $email): array;
    public function findByCpf(string $cpf): array;
}
