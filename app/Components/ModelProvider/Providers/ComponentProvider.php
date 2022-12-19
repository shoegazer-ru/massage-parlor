<?php

declare(strict_types=1);

namespace App\Components\ModelProvider\Providers;

use App\Components\ModelProvider\Interfaces\ModelProviderComponentInterface;
use App\Components\ModelProvider\ModelProviderComponent;
use App\Repositories\RepositoryProvider;
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
        $this->app->singleton(ModelProviderComponentInterface::class, function ($app) {
            return new ModelProviderComponent(
                $app->make(RepositoryProvider::class)
            );
        });
    }
}
