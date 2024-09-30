<?php

use App\Http\Middleware\CheckApiTokenInRoute;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->prependToGroup('web', CheckApiTokenInRoute::class);
        $middleware->redirectGuestsTo(fn (Request $request) => $request->expectsJson() ? null :  route('web.register'));
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
