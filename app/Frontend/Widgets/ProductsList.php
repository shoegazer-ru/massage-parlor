<?php

namespace App\Frontend\Widgets;

use App\Frontend\Components\Products\Interfaces\ProductsComponentInterface;

/**
 * [Description ModelList]
 */
class ProductsList extends BaseWidget
{
    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run(ProductsComponentInterface $productsComponent)
    {
        // @todo: Сделать типы разделов
        $widget = $productsComponent->getListWidget(3);

        return view('frontend.products.products-list-widget', [
            'widget' => $widget
        ]);
    }
}
