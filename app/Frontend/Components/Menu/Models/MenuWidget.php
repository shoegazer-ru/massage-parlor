<?php

namespace App\Frontend\Components\Menu\Models;

use App\Components\ModelProvider\Models\ModelItem;

/**
 * [Description Model]
 */
class MenuWidget
{
    /**
     * @var ModelItem[]
     */
    public array $sections;

    public function __construct(
        array $sections
    ) {
        $this->sections = $sections;
    }
}
