<?php

namespace App\Admin\Components\Dashboard\Models;

use App\Admin\Components\Common\Models\Link;

/**
 * [Description Model]
 */
class MenuWidget
{
    /**
     * @var Link[]
     */
    public array $links;

    public function __construct(
        array $links
    ) {
        $this->links = $links;
    }
}
