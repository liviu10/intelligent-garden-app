<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Import application's settings
use App\BusinessLogic\Interfaces\Admin\Settings\ListOfEquipmentInterface;
use App\BusinessLogic\Services\Admin\Settings\ListOfEquipmentService;
use App\BusinessLogic\Interfaces\Admin\Settings\EquipmentReadingInterface;
use App\BusinessLogic\Services\Admin\Settings\EquipmentReadingService;
use App\BusinessLogic\Interfaces\Admin\Settings\UserInterface;
use App\BusinessLogic\Services\Admin\Settings\UserService;
use App\BusinessLogic\Interfaces\Admin\Settings\UserRoleTypeInterface;
use App\BusinessLogic\Services\Admin\Settings\UserRoleTypeService;

class BusinessLogicProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Register application's settings interfaces and services
        $this->app->bind( ListOfEquipmentInterface::class, ListOfEquipmentService::class );
        $this->app->bind( EquipmentReadingInterface::class, EquipmentReadingService::class );
        $this->app->bind( UserInterface::class, UserService::class );
        $this->app->bind( UserRoleTypeInterface::class, UserRoleTypeService::class );
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
