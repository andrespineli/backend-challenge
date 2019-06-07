<?php

namespace App\Ecommerce\V1\Infrastructure\Repositories;

interface Repository
{
    public function create($customer) : object; 
    public function update($data) : object;  
    public function getAll() : object;   
    public function findById($id) : object;   
}