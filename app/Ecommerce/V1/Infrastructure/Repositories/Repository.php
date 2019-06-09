<?php

namespace App\Ecommerce\V1\Infrastructure\Repositories;

interface Repository
{
    public function create(array $customer): array;
    public function update(array $data): array;
    public function all(): array;
    public function findById(int $id): array;
}
