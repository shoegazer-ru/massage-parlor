<?php

namespace App\Admin\Components\Breadcrumbs\Models;

use App\Admin\Components\Common\Models\Link;

/**
 * [Description Model]
 */
class BreadcrumbsWidget
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
