<?php

namespace App\Providers;

use App\Repositories\AttributeRepository;
use App\Repositories\AuthRepository;
use App\Repositories\Interfaces\AttributeRepositoryInterface;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use App\Repositories\Interfaces\TimesheetRepositoryInterface;
use App\Repositories\ProjectRepository;
use App\Repositories\TimesheetRepository;
use App\Services\AttributeService;
use App\Services\ProjectService;
use App\Services\TimesheetService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);

        $this->app->bind(AttributeRepositoryInterface::class, AttributeRepository::class);
        $this->app->singleton(AttributeService::class, function ($app) {
            return new AttributeService($app->make(AttributeRepositoryInterface::class));
        });

        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
        $this->app->singleton(ProjectService::class, function ($app) {
            return new ProjectService($app->make(ProjectRepositoryInterface::class));
        });

        $this->app->bind(TimesheetRepositoryInterface::class, TimesheetRepository::class);
        $this->app->singleton(TimesheetService::class, function ($app) {
            return new TimesheetService($app->make(TimesheetRepositoryInterface::class));
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
