<?php

namespace App\Ecommerce\V1\Components\Auth;

use App\Ecommerce\V1\Components\Auth\AuthComponent;
use App\Ecommerce\V1\Components\Auth\AuthRepository;
use App\Ecommerce\V1\Components\Customer\CustomerComponent;

class Auth implements AuthComponent
{
    private $repository;
    private $customerComponent;

    public function __construct(CustomerComponent $customerComponent, AuthRepository $repository)
    {
        $this->customerComponent = $customerComponent;
        $this->repository = $repository;
    }

    public function login(array $login): array
    {
        $customer = $this->customerComponent->getCustomerByEmail($login['email']);

        $token = $this->generateToken();
        $auth = $this->customerComponent->setAuthToken($customer['id'], $token);

        if (!$auth) {
            return ['error' => 'Authentication failure.'];
        }

        return ['api_token' => $auth['api_token']];
    }

    public function generateToken(): string
    {
        $first = sha1(str_random(64));
        $second = sha1(str_random(64));
        return "{$first}.{$second}";
    }

    public function getAuthEntity(): array
    {
        return $this->repository->getAuthEntity();
    }

    public function hashPassword(string $password): string
    {
        return $this->repository->hashPassword($password);
    }

    public function verifyEmailAndPass(string $email, string $pass): array
    {
        try {
            $customer = $this->customerComponent->getCustomerByEmail($email);
            $password = $this->repository->verifyHashPassword($pass, $customer['password']);

            if (!$password) {
                throw new \Exception("Incorrect password for email {$email}.", 1);
            }

            $verified['email'] = true;
            $verified['password'] = true;
            return $verified;
        } catch (\Throwable $th) {
            $verified['message'] = "Not found email.";
            $verified['email'] = false;
            $verified['field'] = 'email';

            if ($th->getCode() == 1) {
                $verified['message'] = $th->getMessage();
                $verified['password'] = false;
                $verified['field'] = 'password';
            }

            return $verified;
        }
    }
}
