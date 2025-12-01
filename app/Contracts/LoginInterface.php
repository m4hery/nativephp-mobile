<?php

namespace App\Contracts;

interface LoginInterface
{
    public function login(string $login, string $password);
}
