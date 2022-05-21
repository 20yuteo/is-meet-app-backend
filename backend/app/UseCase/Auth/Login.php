<?php

namespace App\UseCase\Auth;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class Login {
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function excecute(Request $request)
    {
        /** 認証処理 */
        if (Auth::attempt($request->only('email', 'password'))) {
            $this->user = Auth::user();
        }
        return $this->user;
    }
}