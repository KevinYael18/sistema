
protected $listen = [
    \App\Events\ProductoGuardado::class => [
        \App\Listeners\RegistrarActividad::class,
    ],
];