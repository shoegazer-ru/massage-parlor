<?php

namespace App\Admin\Components\Common\Models;

use App\Admin\Components\Common\Models\FormField;

/**
 * [Description Model]
 */
class Form
{
    /**
     * @var string
     */
    public string $title;

    /**
     * @var string
     */
    public string $action;

    /**
     * @var string
     */
    public string $method = 'post';

    /**
     * @var FormField[]
     */
    public array $fields;

    public function __construct(
        string $title,
        string $action,
        ?string $method = null
    ) {
        $this->title = $title;
        $this->action = $action;
        $this->method = $method ?: $this->method;
    }

    /**
     * @param FormField[] $fields
     * 
     * @return void
     */
    public function setFields(array $fields): void
    {
        $this->fields = $fields;
    }

    public function addField(FormField $field): void
    {
        $this->fields[] = $field;
    }

    /**
     * @param array $config
     * 
     * @return static
     */
    public static function buildForm(array $config): static
    {
        $form = new static($config['title'], $config['action']);

        $fieldsConfig = $config['fields'] ?? null;
        if ($fieldsConfig) {
            foreach ($fieldsConfig as $fieldConfig) {
                $form->addField(FormField::buildField($fieldConfig));
            }
        }

        return $form;
    }
}
