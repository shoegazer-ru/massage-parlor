<?php

namespace App\Admin\Widgets;

use App\Admin\Components\Models\Interfaces\ModelsComponentInterface;
use Throwable;

class ModelDeletor extends BaseWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'modelName' => 'unknownModel',
        'modelId' => null
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run(ModelsComponentInterface $modelsComponent)
    {
        try {
            $editor = $modelsComponent->getDeletor($this->config['modelName'], $this->config['modelId']);
        } catch (Throwable $e) {
            return $this->handleException($e);
        }

        return view('admin.model.editor-widget', [
            'editor' => $editor
        ]);
    }
}
