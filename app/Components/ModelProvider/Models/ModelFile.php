<?php

namespace App\Components\ModelProvider\Models;

class ModelFile
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
    public string $downloadUrl;

    /**
     * @param int $id
     * @param string $name
     * @param string $ext
     * @param string $downloadUrl
     */
    public function __construct(int $id, string $name, string $ext, string $downloadUrl)
    {
        $this->id = $id;
        $this->name = $name;
        $this->ext = $ext;
        $this->downloadUrl = $downloadUrl;
    }
}
