<?php

namespace App\Admin\Components\Models\Models;

/**
 * [Description Model]
 */
class Action
{
    /**
     * @var string
     */
    public string $caption;

    /**
     * @var string
     */
    public string $url;

    /**
     * @var string
     */
    public string $name = '';

    public function __construct(
        string $caption,
        string $url,
        string $name = ''
    ) {
        $this->caption = $caption;
        $this->url = $url;
        $this->name = $name;
    }
}
