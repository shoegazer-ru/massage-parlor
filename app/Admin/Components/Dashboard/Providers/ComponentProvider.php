<?php

declare(strict_types=1);

namespace App\Admin\Components\Dashboard\Providers;

use App\Admin\Components\Dashboard\DashboardComponent;
use App\Admin\Components\Dashboard\Interfaces\DashboardComponentInterface;
use Illuminate\Support\ServiceProvider;

class ComponentProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(DashboardComponentInterface::class, function ($app) {
            return new DashboardComponent();
        });
    }
}
