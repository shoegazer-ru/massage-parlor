<?php

namespace App\Admin\Components\Models\Models;

use App\Admin\Components\Models\Models\Action;

/**
 * [Description Model]
 */
class Model
{
    /**
     * @var string
     */
    public string $modelName;

    /**
     * @var string
     */
    public string $caption;

    /**
     * @var array
     */
    public array $actions;

    /**
     * @param string $modelName
     * @param string $caption
     */
    public function __construct(string $modelName, string $caption)
    {
        $this->modelName = $modelName;
        $this->caption = $caption;
    }

    /**
     * @param Action[] $actions
     * 
     * @return void
     */
    public function setActions(array $actions): void
    {
        $this->actions = $actions;
    }
}
