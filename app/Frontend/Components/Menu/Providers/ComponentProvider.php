<?php

declare(strict_types=1);

namespace App\Frontend\Components\Menu\Providers;

use App\Frontend\Components\Menu\Interfaces\MenuComponentInterface;
use App\Frontend\Components\Menu\MenuComponent;
use App\Repositories\SectionRepository;
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
        $this->app->singleton(MenuComponentInterface::class, function ($app) {
            return new MenuComponent(
                $app->make(SectionRepository::class)
            );
        });
    }
}
