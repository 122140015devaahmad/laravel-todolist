<?php

namespace App\Providers;

use App\Services\Implementations\TodoServicesImpl;
use App\Services\TodoServices;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TodolistServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        TodoServices::class => TodoServicesImpl::class
    ];
    public function provides(): array{
        return [
            TodoServices::class
        ];
    }
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
