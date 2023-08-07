<?php

namespace App\Providers;

use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\PostRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        PostRepositoryInterface::class => PostRepository::class
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
