<?php

declare(strict_types=1);

namespace App\Frontend\Components\Products\Providers;

use App\Components\ModelProvider\Interfaces\ModelProviderComponentInterface;
use App\Frontend\Components\Products\Interfaces\ProductsComponentInterface;
use App\Frontend\Components\Products\ProductsComponent;
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
        $this->app->singleton(ProductsComponentInterface::class, function ($app) {
            return new ProductsComponent(
                $app->make(ModelProviderComponentInterface::class)
            );
        });
    }
}
