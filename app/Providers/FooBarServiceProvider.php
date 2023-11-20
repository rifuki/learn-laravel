<?php

namespace App\Providers;

use App\Data\Bar;
use App\Data\Foo;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class FooBarServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        HelloService::class => HelloServiceIndonesia::class
    ];
    /**
     * Register services.
     */
    public function register()
    
    {
        $this->app->singleton(Foo::class, function($app) {
            return new Foo();
        });
        
        $this->app->singleton(Bar::class, function($app) {
            $foo = $app->make(Foo::class);
            return new Bar($foo);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    public function provides(): array /* <- override provides method to only load neccessary providers only */
    {
        return [
            HelloService::class,
            Foo::class,
            Bar::class
        ];
    }

    
}
