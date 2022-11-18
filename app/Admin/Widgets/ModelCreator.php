<?php

namespace App\Admin\Widgets;

use App\Admin\Components\Models\Interfaces\ModelsComponentInterface;

/**
 * [Description ModelList]
 */
class ModelCreator extends BaseWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'modelName' => 'unknownModel'
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run(ModelsComponentInterface $modelsComponent)
    {
        $editor = $modelsComponent->getCreator($this->config['modelName']);

        return view('admin.model.editor-widget', [
            'editor' => $editor
        ]);
    }
}
