protected $routeMiddleware = [
    // ... other middleware ...
    'auth.erp' => \App\Http\Middleware\EnsureUserIsAuthenticated::class,
    'role' => \App\Http\Middleware\CheckUserRole::class,
];