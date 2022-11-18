<?php

namespace App\Admin\Widgets;

use App\Admin\Components\Dashboard\Interfaces\DashboardComponentInterface;
use Arrilot\Widgets\AbstractWidget;

/**
 * [Description ModelList]
 */
class DashboardMenu extends AbstractWidget
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
    public function run(DashboardComponentInterface $dashboard)
    {
        $widget = $dashboard->getMenu();

        return view('admin.dashboard.menu-widget', [
            'widget' => $widget
        ]);
    }
}
