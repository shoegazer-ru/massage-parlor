<?php

namespace App\Admin\Components\Models\Models;

/**
 * [Description Model]
 */
class ListWidget
{
    /**
     * @var Action[]
     */
    public array $actions;

    /**
     * @var Model[]
     */
    public array $models;

    public function __construct(
        array $models,
        array $actions = []
    ) {
        $this->models = $models;
        $this->actions = $actions;
    }
}
