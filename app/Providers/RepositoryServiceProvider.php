<?php

namespace App\Providers;

use App\Repository\EloquentRepositoryInterface;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Eloquent\JobRepository;
use App\Repository\JobRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(JobRepositoryInterface::class, JobRepository::class);
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
