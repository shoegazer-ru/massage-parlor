<?php

namespace App\Components\ModelProvider\Interfaces;

use App\Components\ModelProvider\Models\ModelItem;

interface ModelProviderComponentInterface
{
    const FILES = 'files';

    /**
     * @param string $modelName
     * @param array $criteria
     * @param array $references
     * 
     * @return ModelItem[]
     */
    public function getList(string $modelName, array $criteria = [], array $references = []): array;

    /**
     * @param string $modelName
     * @param array $criteria
     * @param array $references
     * 
     * @return ModelItem
     */
    public function getItem(string $modelName, array $criteria = [], array $references = []): ModelItem;

    /**
     * @param ModelItem[] $models
     * @param string $field
     * 
     * @return array
     */
    public function getModelsField(array $models, string $field): array;
}
