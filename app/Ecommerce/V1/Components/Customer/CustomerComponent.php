<?php

namespace App\Ecommerce\V1\Components\Customer;

interface CustomerComponent
{
    public function newCustomer(array $request): array;
    public function getCustomers(): array;
    public function getCustomerByEmail(string $email): array;
    public function getCustmerByCpf(string $cpf): array;
    public function setAuthToken(int $id, string $token): array;
}
