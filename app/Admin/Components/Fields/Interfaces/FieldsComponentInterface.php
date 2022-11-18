<?php

namespace App\Admin\Components\Fields\Interfaces;

use App\Admin\Components\Common\Models\Editor;
use App\Admin\Components\Fields\Models\ListWidget;
use App\Admin\Components\Fields\Models\Model;
use App\Models\Field;
use Illuminate\Database\Eloquent\Collection;

interface FieldsComponentInterface
{
    /**
     * @return array
     */
    public function getMessages(): array;

    /**
     * @param string $fieldName
     * 
     * @return Model[]
     */
    public function getList(string $fieldName): ListWidget;

    /**
     * @param Collection $list
     * 
     * @return Model[]
     */
    public function buildModelList(Collection $list): array;

    /**
     * @param Field $item
     * 
     * @return Model
     */
    public function buildModelItem(Field $item): Model;

    /**
     * @param string $fieldName
     * @param int|null $id
     * 
     * @return Editor
     */
    public function getEditor(string $fieldName, ?int $id = null): Editor;

    /**
     * @param string $fieldName
     * @param int $id
     * 
     * @return Editor
     */
    public function getDeletor(string $fieldName, int $id): Editor;

    /**
     * @param string $fieldName
     * @param int|null $id
     * @param array $input
     * 
     * @return Field
     */
    public function saveField(string $fieldName, ?int $id = null, array $input = []): Field;

    /**
     * @param int $id
     * @param array $input
     * 
     * @return void
     */
    public function deleteField(int $id, array $input): void;
}
