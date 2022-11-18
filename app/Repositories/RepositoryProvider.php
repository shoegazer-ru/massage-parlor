<?php

namespace App\Repositories;

use Illuminate\Support\Facades\App;

class RepositoryProvider
{
    public function getRepository($modelName)
    {
        $repositoryClass = config('models.repositories.' . $modelName);
        return App::make($repositoryClass);
    }
}
