<?php

namespace App\Admin\Widgets;

use App\Admin\Components\Breadcrumbs\Interfaces\BreadcrumbsComponentInterface;
use App\Admin\Components\Models\Interfaces\ModelsComponentInterface;
use Arrilot\Widgets\AbstractWidget;

/**
 * [Description ModelList]
 */
class Breadcrumbs extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'item' => '',
        'modelName' => '',
        'modelId' => 0,
        'fieldName' => '',
        'params' => []
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run(BreadcrumbsComponentInterface $breadcrumbs)
    {
        switch ($this->config['item']) {
            case 'model-list':
                $widget = $breadcrumbs->getModelListBreadcrumbs($this->config['modelName'], $this->config['params']);
                break;
            case 'model-editor':
                $widget = $breadcrumbs->getModelEditorBreadcrumbs($this->config['modelName'], $this->config['modelId']);
                break;
            case 'model-creator':
                $widget = $breadcrumbs->getModelCreatorBreadcrumbs($this->config['modelName'], $this->config['params']);
                break;
            case 'model-deletor':
                $widget = $breadcrumbs->getModelDeletorBreadcrumbs($this->config['modelName'], $this->config['modelId']);
                break;
            case 'auth':
                $widget = $breadcrumbs->getAuthBreadcrumbs();
                break;
            case 'fields-list':
                $widget = $breadcrumbs->getFieldsListBreadcrumbs($this->config['fieldName']);
                break;
            case 'field-editor':
                $widget = $breadcrumbs->getFieldEditorBreadcrumbs($this->config['fieldName'], $this->config['modelId']);
                break;
            case 'field-deletor':
                $widget = $breadcrumbs->getFieldDeletorBreadcrumbs($this->config['fieldName'], $this->config['modelId']);
                break;
            default:
                $widget = $breadcrumbs->getMainBreadcrumbs($this->config['item']);
                break;
        }

        return view('admin.breadcrumbs.breadcrumbs-widget', [
            'widget' => $widget
        ]);
    }
}
