<?php

namespace App\Frontend\Widgets;

use App\Frontend\Components\Menu\Interfaces\MenuComponentInterface;

/**
 * [Description ModelList]
 */
class ProductsMenu extends BaseWidget
{
    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run(MenuComponentInterface $menuComponent)
    {
        // @todo: Сделать типы разделов
        $widget = $menuComponent->getSubmenuWidget(3);

        return view('frontend.products.products-menu-widget', [
            'widget' => $widget
        ]);
    }
}
