<?php

namespace App\Admin\Components\Models\Models;

/**
 * [Description Model]
 */
class FormField
{
    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $type;

    /**
     * @var string|null
     */
    public ?string $label;

    /**
     * @var string|null
     */
    public ?string $value;

    /**
     * @var array|null
     */
    public ?array $data;

    public function __construct(
        string $name,
        string $type,
        ?string $label = null,
        ?string $value = null,
        ?array $data = null
    ) {
        $this->name = $name;
        $this->type = $type;
        $this->label = $label;
        $this->value = $value;
        $this->data = $data;
    }

    /**
     * @param array $config
     * 
     * @return static
     */
    public static function buildField(array $config): static
    {
        return new static(
            $config['name'],
            $config['type'],
            $config['label'] ?? null,
            $config['value'] ?? null,
            $config['data'] ?? null
        );
    }
}
