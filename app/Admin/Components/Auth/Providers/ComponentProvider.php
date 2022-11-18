<?php

declare(strict_types=1);

namespace App\Admin\Components\Auth\Providers;

use App\Admin\Components\Auth\AuthComponent;
use App\Admin\Components\Auth\Interfaces\AuthComponentInterface;
use Components\DataObjectManager\Interfaces\DataObjectManagerInterface;
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
        $this->app->bind(AuthComponentInterface::class, function ($app) {
            return new AuthComponent(
                $app->make(DataObjectManagerInterface::class)
            );
        });
    }
}
