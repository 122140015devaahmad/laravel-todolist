<?php

namespace App\Services;

interface UserServices
{
    public function login(string $email, string $password): bool;
}