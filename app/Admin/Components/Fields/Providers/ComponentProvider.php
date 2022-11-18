<?php

declare(strict_types=1);

namespace App\Admin\Components\Fields\Providers;

use App\Admin\Components\Fields\FieldsComponent;
use App\Admin\Components\Fields\Interfaces\FieldsComponentInterface;
use App\Admin\Components\Files\Interfaces\FilesComponentInterface;
use App\Repositories\FieldRepository;
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
        $this->app->singleton(FieldsComponentInterface::class, function ($app) {
            return new FieldsComponent(
                $app->make(FieldRepository::class),
                $app->make(FilesComponentInterface::class)
            );
        });
    }
}
