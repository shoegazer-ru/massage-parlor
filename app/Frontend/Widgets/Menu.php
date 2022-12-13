<?php

namespace App\Frontend\Widgets;

use App\Frontend\Components\Menu\Interfaces\MenuComponentInterface;

/**
 * [Description ModelList]
 */
class Menu extends BaseWidget
{
    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run(MenuComponentInterface $menuComponent)
    {
        $widget = $menuComponent->getMenuWidget();

        return view('frontend.menu.widget', [
            'widget' => $widget
        ]);
    }
}
