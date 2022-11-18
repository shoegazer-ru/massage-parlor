<?php

namespace App\Admin\Widgets;

use App\Admin\Components\Models\Interfaces\ModelsComponentInterface;
use Arrilot\Widgets\AbstractWidget;

/**
 * [Description ModelList]
 */
class ModelListLink extends AbstractWidget
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
        $link = $modelsComponent->getListLink($this->config['modelName']);

        return view('admin.model.list-link-widget', [
            'link' => $link
        ]);
    }
}
