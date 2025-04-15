<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PostService;
use App\Services\UserService;
use App\Repositories\UserRepository;
use App\Models\User;
use App\Observers\UserObserver;
use App\Models\Post;
use App\Observers\PostObserver;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Create a new service provider instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function __construct($app)
    {
        parent::__construct($app);
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(PostService::class, function ($app) {
            return new PostService();
        });
        $this->app->bind(UserRepository::class, function ($app) {
            return new UserRepository();
        });
        $this->app->bind(UserService::class, function ($app) {
            return new UserService($app->make(UserRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Post::observe(PostObserver::class);
    }
}
