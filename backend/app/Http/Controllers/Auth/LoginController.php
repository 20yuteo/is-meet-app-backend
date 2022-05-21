<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UseCase\Auth\Login;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;

class LoginController extends Controller
{
    public function __invoke(Login $loginUseCase, LoginRequest $request) {
        clock($request->all());
        $res = $loginUseCase->excecute($request);
        return new UserResource($res);
    }
}
