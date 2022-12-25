<?php

namespace App\Frontend\Components\Products\Models;

use App\Components\ModelProvider\Models\ModelImage;

class ListItem
{
    /**
     * @var int
     */
    public int $id;

    /**
     * @var string
     */
    public string $caption;

    /**
     * @var string
     */
    public string $annotation;

    /**
     * @var string
     */
    public string $moreLabel;

    /**
     * @var string
     */
    public string $basketLabel;

    /**
     * @var ModelImage|null
     */
    public ?ModelImage $image;

    public function __construct(
        int $id,
        string $caption,
        string $annotation,
        string $moreLabel,
        string $basketLabel,
        ?ModelImage $image = null
    ) {
        $this->id = $id;
        $this->caption = $caption;
        $this->annotation = $annotation;
        $this->moreLabel = $moreLabel;
        $this->basketLabel = $basketLabel;
        $this->image = $image;
    }
}
