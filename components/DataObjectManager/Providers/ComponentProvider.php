<?php

declare(strict_types=1);

namespace Components\DataObjectManager\Providers;

use Components\DataObjectManager\DataObjectManager;
use Components\DataObjectManager\Interfaces\DataObjectManagerInterface;
use Components\DataObjectManager\Validators\DataObjectValidator;
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
        $this->app->bind(DataObjectManagerInterface::class, function () {
            return new DataObjectManager(
                new DataObjectValidator()
            );
        });
    }
}
