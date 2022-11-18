<?php

namespace App\Admin\Components\Common\Models;

use App\Models\File as ModelsFile;

/**
 * [Description Model]
 */
class Image extends File
{
    /**
     * @var string
     */
    public string $src;

    public function __construct(
        string $caption,
        string $src,
        array $actions = []
    ) {
        $this->caption = $caption;
        $this->src = $src;
        $this->actions = $actions;
    }

    /**
     * @param ModelsFile $file
     * 
     * @return self
     */
    public static function fromFile(ModelsFile $file): self
    {
        return new self(
            $file->name,
            self::getImageSrcString($file)
        );
    }

    public static function getImageSrcString($file, $sizeName = 'thumb')
    {
        $prefixFolder = substr($file->hash, 0, 2);
        return asset('/uploads/images/' . $sizeName . '/' . $prefixFolder . '/' . $file->hash . '.' . $file->ext);
    }
}
