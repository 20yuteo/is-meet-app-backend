<?php

namespace App\UseCase\Admin;

use Illuminate\Routing\Pipeline;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use App\Actions\Admin\AttemptToAuthenticate;
use App\Responses\AdminLoginResponse;
use Illuminate\Contracts\Auth\StatefulGuard;
// use Laravel\Fortify\Contracts\LoginResponse;

    class Login {
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    public function execute(LoginRequest $request)
    {
        return $this->loginPipeline($request)->then(function ($request) {
            return app(AdminLoginResponse::class);
        });
    }

    /**
     * Get the authentication pipeline instance.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Pipeline\Pipeline
     */
    protected function loginPipeline(LoginRequest $request)
    {
        return (new Pipeline(app()))->send($request)->through(array_filter([
            AttemptToAuthenticate::class,
            PrepareAuthenticatedSession::class,
        ]));
    }
}