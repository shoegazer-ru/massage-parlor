<?php

namespace App\Admin\Controllers;

use App\Admin\Components\Auth\Interfaces\AuthComponentInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  AuthComponentInterface $auth
     *
     * @return Response
     */
    public function login(Request $request, AuthComponentInterface $auth)
    {
        $credentials = $request->only('name', 'password');
        if ($credentials) {
            if ($auth->login($credentials)) {
                return redirect()->intended('admin/dashboard');
            }
        }

        return view('admin.auth.login');
    }

    /**
     * @param AuthComponentInterface $auth
     * 
     * @return Response
     */
    public function logout(AuthComponentInterface $auth)
    {
        $auth->logout();
        return redirect()->intended('admin/login');
    }
}
