<?php

namespace App\Frontend\Components\Products\Models;

use App\Components\ModelProvider\Models\ModelItem;

class ListWidget
{
    /**
     * @var ModelItem[]
     */
    public array $publications;

    public function __construct(
        array $publications
    ) {
        $this->publications = $publications;
    }
}
