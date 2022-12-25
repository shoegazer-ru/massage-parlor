<?php

namespace App\Components\ModelProvider\Models;

class ModelImage
{
    /**
     * @var int
     */
    public int $id;

    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $ext;

    /**
     * @var string
     */
    public string $src;

    /**
     * @var string
     */
    public string $thumbSrc;

    /**
     * @param int $id
     * @param string $name
     * @param string $ext
     * @param string $src
     * @param string $thumbSrc
     */
    public function __construct(int $id, string $name, string $ext, string $src, string $thumbSrc)
    {
        $this->id = $id;
        $this->name = $name;
        $this->ext = $ext;
        $this->src = $src;
        $this->thumbSrc = $thumbSrc;
    }
}
