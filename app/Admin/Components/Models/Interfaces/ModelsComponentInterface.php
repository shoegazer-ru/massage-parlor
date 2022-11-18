<?php

namespace App\Admin\Components\Models\Interfaces;

use App\Admin\Components\Common\Models\Link;
use App\Admin\Components\Models\Models\Editor;
use App\Admin\Components\Models\Models\ListWidget;
use App\Admin\Components\Models\Models\MenuWidget;
use App\Admin\Components\Models\Models\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model as EloquentModel;

interface ModelsComponentInterface
{
    /**
     * @return array
     */
    public function getMessages(): array;

    /**
     * @param string $modelName
     * @param array|null $filter
     * 
     * @return Model[]
     */
    public function getList(string $modelName, ?array $filter = null): ListWidget;

    /**
     * @param string $modelName
     * @param Collection $list
     * 
     * @return Model[]
     */
    public function buildModelList(string $modelName, Collection $list): array;

    /**
     * @param EloquentModel $item
     * 
     * @return Model
     */
    public function buildModelItem(EloquentModel $item): Model;

    /**
     * @param string $modelName
     * @param int $modelId
     * 
     * @return Editor
     */
    public function getEditor(string $modelName, int $modelId): Editor;

    /**
     * @param string $modelName
     * 
     * @return Editor
     */
    public function getCreator(string $modelName): Editor;

    /**
     * @param string $modelName
     * @param int $modelId
     * 
     * @return Editor
     */
    public function getDeletor(string $modelName, int $modelId): Editor;

    /**
     * @param string $modelName
     * 
     * @return Link
     */
    public function getListLink(string $modelName): Link;

    /**
     * @return MenuWidget
     */
    public function getMenu(): MenuWidget;

    /**
     * @param string $modelName
     * @param int $modelId
     * @param array $input
     * 
     * @return void
     */
    public function editModel(string $modelName, int $modelId, array $input): EloquentModel;

    /**
     * @param string $modelName
     * @param array $input
     * 
     * @return void
     */
    public function createModel(string $modelName, array $input): EloquentModel;

    /**
     * @param string $modelName
     * @param int $modelId
     * @param array $input
     * 
     * @return void
     */
    public function deleteModel(string $modelName, int $modelId, array $input): void;
}
