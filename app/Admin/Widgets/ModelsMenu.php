<?php

namespace App\Admin\Widgets;

use App\Admin\Components\Models\Interfaces\ModelsComponentInterface;
use Arrilot\Widgets\AbstractWidget;

/**
 * [Description ModelList]
 */
class ModelsMenu extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run(ModelsComponentInterface $modelsComponent)
    {
        $widget = $modelsComponent->getMenu();

        return view('admin.model.menu-widget', [
            'widget' => $widget
        ]);
    }
}
