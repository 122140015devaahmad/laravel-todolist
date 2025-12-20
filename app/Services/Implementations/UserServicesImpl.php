<?php

namespace App\Services\Implementations;

use App\Services\UserServices;

class UserServicesImpl implements UserServices{
    private array $users = [
        'admin' => 'admin123',
        'user' => 'user123',
    ];
        
    public function login(string $user, string $password): bool{
        if(isset($this->users[$user]) && $this->users[$user] === $password){
            return true;
        }
        return false;
    }
}