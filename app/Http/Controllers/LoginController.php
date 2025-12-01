<?php

namespace App\Http\Controllers;

use App\Contracts\LoginInterface;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(private LoginInterface $loginService) {}

    public function index()
    {
        return view('login');
    }

    public function store(LoginRequest $request) {
        try {
            $this->loginService->login(
                $request->login,
                $request->password
            );

            return redirect()->route('menu');
        } catch (\RuntimeException $e) {
            return redirect()->back()->withErrors(['login' => $e->getMessage()])->withInput();
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
