<?php

'api' => [
    \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    'throttle:api',
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
];


protected $routeMiddleware = [
    // ...
    'check.module' => \App\Http\Middleware\CheckModuleActive::class,
];