<?php

namespace App\Admin\Widgets;

use App\Admin\Components\Fields\Interfaces\FieldsComponentInterface;
use Arrilot\Widgets\AbstractWidget;

/**
 * [Description ModelList]
 */
class FieldEditor extends AbstractWidget
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
        $editor = $fieldsComponent->getEditor($this->config['fieldName'], $this->config['modelId']);

        return view('admin.model.editor-widget', [
            'editor' => $editor
        ]);
    }
}
