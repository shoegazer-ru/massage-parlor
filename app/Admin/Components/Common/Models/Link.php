<?php

namespace App\Admin\Components\Common\Models;

/**
 * [Description Model]
 */
class Link
{
    /**
     * @var string
     */
    public string $caption;

    /**
     * @var string
     */
    public string $url;

    public function __construct(
        string $caption,
        string $url
    ) {
        $this->caption = $caption;
        $this->url = $url;
    }
}
