<?php

namespace App\Frontend\Components\Menu\Models;

use App\Models\Section;
use Illuminate\Database\Eloquent\Collection;

/**
 * [Description Model]
 */
class MenuWidget
{
    /**
     * @var Collection
     */
    public Collection $sections;

    public function __construct(
        Collection $sections
    ) {
        $this->sections = $sections;
    }
}
