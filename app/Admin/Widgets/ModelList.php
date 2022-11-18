<?php

namespace App\Admin\Widgets;

use App\Admin\Components\Models\Interfaces\ModelsComponentInterface;
use Arrilot\Widgets\AbstractWidget;

/**
 * [Description ModelList]
 */
class ModelList extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'modelName' => 'unknownModel',
        'params' => []
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run(ModelsComponentInterface $modelsComponent)
    {
        $widget = $modelsComponent->getList(
            $this->config['modelName'],
            $this->config['params']
        );

        return view('admin.model.list-widget', [
            'modelName' => $this->config['modelName'],
            'widget' => $widget
        ]);
    }
}
