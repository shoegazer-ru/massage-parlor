<?php

namespace App\Components\ModelProvider\Models;

class ModelImage
{
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
     * @param string $name
     * @param string $ext
     * @param string $src
     * @param string $thumbSrc
     */
    public function __construct(string $name, string $ext, string $src, string $thumbSrc)
    {
        $this->name = $name;
        $this->ext = $ext;
        $this->src = $src;
        $this->thumbSrc = $thumbSrc;
    }
}
