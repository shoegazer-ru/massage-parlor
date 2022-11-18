<?php

namespace App\Admin\Widgets;

use App\Admin\Components\Fields\Interfaces\FieldsComponentInterface;
use Arrilot\Widgets\AbstractWidget;

/**
 * [Description ModelList]
 */
class FieldsList extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'fieldName' => ''
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run(FieldsComponentInterface $fieldsComponent)
    {
        $widget = $fieldsComponent->getList($this->config['fieldName']);

        return view('admin.fields.list-widget', [
            'fieldName' => $this->config['fieldName'],
            'widget' => $widget
        ]);
    }
}
