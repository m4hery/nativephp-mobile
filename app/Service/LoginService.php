<?php

namespace App\Service;

use App\Contracts\LoginInterface;
use Illuminate\Support\Facades\Auth;
use RuntimeException;

class LoginService implements LoginInterface
{
   public function login(string $login, string $password)
   {
    if(! Auth::attempt(['login' => $login, 'password' => $password])) {
        throw new RuntimeException('Identifiants Incorects');
    }

    return Auth::user();
   }

}
