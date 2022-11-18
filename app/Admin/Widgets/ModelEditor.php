<?php

namespace App\Admin\Widgets;

use App\Admin\Components\Models\Interfaces\ModelsComponentInterface;
use Arrilot\Widgets\AbstractWidget;

/**
 * [Description ModelList]
 */
class ModelEditor extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'modelName' => 'unknownModel',
        'modelId' => null
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run(ModelsComponentInterface $modelsComponent)
    {
        $editor = $modelsComponent->getEditor($this->config['modelName'], $this->config['modelId']);

        return view('admin.model.editor-widget', [
            'editor' => $editor
        ]);
    }
}
