<?php

namespace App\Components\ModelProvider\Models;

use Illuminate\Database\Eloquent\Model;

class ModelItem
{
    /**
     * @var Model
     */
    public Model $model;

    /**
     * @var array
     */
    public array $references;

    /**
     * @param Model $model
     * @param array $references
     */
    public function __construct(Model $model, array $references)
    {
        $this->model = $model;
        $this->references = $references;
    }
}
