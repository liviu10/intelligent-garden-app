<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

// Import application's settings
use App\BusinessLogic\Interfaces\Admin\Settings\UserInterface;
use App\BusinessLogic\Interfaces\Admin\Settings\UserRoleTypeInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register application's settings interfaces and services
        $this->app->bind( UserInterface::class, UserService::class );
        $this->app->bind( UserRoleTypeInterface::class, UserRoleTypeService::class );

        // Register laravel telescope
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->runningUnitTests()) {
            Schema::defaultStringLength(191);
        }
    }
}
