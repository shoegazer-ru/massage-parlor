<?php

namespace App\Admin\Components\Dashboard\Interfaces;

use App\Admin\Components\Dashboard\Models\MenuWidget;

interface DashboardComponentInterface
{
    /**
     * @return MenuWidget
     */
    public function getMenu(): MenuWidget;
}
