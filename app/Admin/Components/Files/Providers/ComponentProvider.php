<?php

declare(strict_types=1);

namespace App\Admin\Components\Files\Providers;

use App\Admin\Components\Files\FilesComponent;
use App\Admin\Components\Files\Interfaces\FilesComponentInterface;
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
        $this->app->singleton(FilesComponentInterface::class, function ($app) {
            return new FilesComponent(
                $app->make(RepositoryProvider::class)
            );
        });
    }
}
