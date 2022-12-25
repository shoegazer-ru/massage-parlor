<?php

namespace App\Frontend\Components\Products\Interfaces;

use App\Frontend\Components\Products\Models\ListWidget;

interface ProductsComponentInterface
{
    /**
     * @return ListWidget
     */
    public function getListWidget(int $sectionId): ListWidget;
}
