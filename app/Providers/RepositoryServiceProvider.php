<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\IRepositories\IEloquentRepository;
use App\Repositories\IRepositories\ILayoutRepository;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\LayoutRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(IEloquentRepository::class, BaseRepository::class);
        $this->app->bind(ILayoutRepository::class, LayoutRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
