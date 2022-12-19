<?php

namespace App\Components\ModelProvider\Models;

class ModelFile
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
    public string $downloadUrl;

    /**
     * @param string $name
     * @param string $ext
     * @param string $downloadUrl
     */
    public function __construct(string $name, string $ext, string $downloadUrl)
    {
        $this->name = $name;
        $this->ext = $ext;
        $this->downloadUrl = $downloadUrl;
    }
}
