<?php

declare(strict_types=1);

namespace App\Admin\Components\Models\Providers;

use App\Admin\Components\Files\Interfaces\FilesComponentInterface;
use App\Admin\Components\Models\Interfaces\ModelsComponentInterface;
use App\Admin\Components\Models\ModelsComponent;
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
        $this->app->singleton(ModelsComponentInterface::class, function ($app) {
            return new ModelsComponent(
                $app->make(RepositoryProvider::class),
                $app->make(FilesComponentInterface::class)
            );
        });
    }
}
