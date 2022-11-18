<?php

declare(strict_types=1);

namespace App\Admin\Components\Breadcrumbs\Providers;

use App\Admin\Components\Breadcrumbs\BreadcrumbsComponent;
use App\Admin\Components\Breadcrumbs\Interfaces\BreadcrumbsComponentInterface;
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
        $this->app->singleton(BreadcrumbsComponentInterface::class, function ($app) {
            return new BreadcrumbsComponent(
                $app->make(RepositoryProvider::class)
            );
        });
    }
}
