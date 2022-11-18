<?php

namespace App\Admin\Components\Models\Models;

use App\Models\File as ModelsFile;

/**
 * [Description Model]
 */
class File
{
    /**
     * @var string
     */
    public string $caption;

    /**
     * @var string
     */
    public string $size;

    /**
     * @var array
     */
    public array $actions;

    public function __construct(
        string $caption,
        string $size,
        array $actions = []
    ) {
        $this->caption = $caption;
        $this->size = $size;
        $this->actions = $actions;
    }

    /**
     * @param array $actions
     * 
     * @return void
     */
    public function setActions(array $actions): void
    {
        $this->actions = $actions;
    }

    /**
     * @param Action $action
     * 
     * @return void
     */
    public function addAction(Action $action): void
    {
        $this->actions[] = $action;
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
            self::getFileSizeString($file->size)
        );
    }

    protected static function getFileSizeString($size)
    {
        if ($size < 1024) {
            return $size . 'B';
        }

        $size = $size / 1024;
        if ($size < 1024) {
            return round($size) . 'KB';
        }

        $size = $size / 1024;
        if ($size < 1024) {
            return round($size, 1) . 'MB';
        }

        $size = $size / 1024;
        return round($size, 2) . 'Gb';
    }
}
