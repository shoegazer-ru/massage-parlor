<?php

namespace App\Frontend\Components\Menu\Interfaces;

use App\Frontend\Components\Menu\Models\MenuWidget;

interface MenuComponentInterface
{
    /**
     * @return MenuWidget
     */
    public function getMenuWidget(): MenuWidget;

    /**
     * @param int $parentId
     * 
     * @return MenuWidget
     */
    public function getSubmenuWidget(int $parentId): MenuWidget;
}
