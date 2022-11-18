<?php

namespace App\Admin\Components\Dashboard;

use App\Admin\Components\Common\Models\Link;
use App\Admin\Components\Dashboard\Interfaces\DashboardComponentInterface;
use App\Admin\Components\Dashboard\Models\MenuWidget;

class DashboardComponent implements DashboardComponentInterface
{
    /**
     * @return MenuWidget
     */
    public function getMenu(): MenuWidget
    {
        $menu = config('admin.dashboard.menu', []);

        $links = [];
        foreach ($menu as $name => $config) {
            $routeName = reset($config['route']);
            $routeParams = array_slice($config['route'], 1);
            $links[] = new Link(
                __('admin.dashboard.menu.' . $name),
                route($routeName, $routeParams)
            );
        }

        return new MenuWidget($links);
    }
}
