<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\LoginRequest;
use Laravel\Fortify\Http\Requests\LoginRequest;
use App\UseCase\Admin\Login;
use App\UseCase\Admin\Logout;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var \App\UseCase\Admin\Login
     */
    protected $loginUseCase;

    protected$logoutUseCase;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->loginUseCase = new Login($guard);
        $this->logoutUseCase = new Logout($guard);
    }

    public function login(LoginRequest $request) {
        return $this->loginUseCase->execute($request);
    }

    public function logout(Request $request) {
        return $this->logoutUseCase->destroy($request);
    }
}
