<?php

namespace App\Admin\Widgets;

use App\Admin\Components\Fields\Interfaces\FieldsComponentInterface;
use Throwable;

class FieldDeletor extends BaseWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'fieldName' => '',
        'modelId' => null
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run(FieldsComponentInterface $fieldsComponent)
    {
        try {
            $editor = $fieldsComponent->getDeletor($this->config['fieldName'], $this->config['modelId']);
        } catch (Throwable $e) {
            return $this->handleException($e);
        }

        return view('admin.model.editor-widget', [
            'editor' => $editor
        ]);
    }
}
