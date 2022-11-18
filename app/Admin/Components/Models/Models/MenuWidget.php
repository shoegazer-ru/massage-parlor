<?php

namespace App\Admin\Components\Models\Models;

use App\Admin\Components\Common\Models\Link;

/**
 * [Description Model]
 */
class MenuWidget
{
    /**
     * @var Action[]
     */
    public array $actions;

    /**
     * @var Link[]
     */
    public array $links;

    public function __construct(
        array $links,
        array $actions = []
    ) {
        $this->links = $links;
        $this->actions = $actions;
    }
}
