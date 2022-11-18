<?php

namespace App\Admin\Components\Fields;

use App\Admin\Components\Common\Models\Action;
use App\Admin\Components\Common\Models\Editor;
use App\Admin\Components\Common\Models\Form;
use App\Admin\Components\Common\Models\File as ModelsFile;
use App\Admin\Components\Common\Models\Image as ModelsImage;
use App\Admin\Components\Fields\Interfaces\FieldsComponentInterface;
use App\Admin\Components\Fields\Models\ListWidget;
use App\Admin\Components\Fields\Models\Model;
use App\Admin\Components\Files\Interfaces\FilesComponentInterface;
use App\Exceptions\AdminModelNotFoundException;
use App\Models\Field;
use App\Models\File;
use App\Repositories\FieldRepository;
use Illuminate\Database\Eloquent\Collection;

class FieldsComponent implements FieldsComponentInterface
{
    private array $messages = [];

    /**
     * @var FieldRepository
     */
    protected FieldRepository $fieldRepository;

    /**
     * @var FilesComponentInterface
     */
    protected FilesComponentInterface $files;

    public function __construct(
        FieldRepository $fieldRepository,
        FilesComponentInterface $files
    ) {
        $this->fieldRepository = $fieldRepository;
        $this->files = $files;
    }

    /**
     * @return array
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * @param string $fieldName
     * 
     * @return Model[]
     */
    public function getList(string $fieldName): ListWidget
    {
        $list = $this->fieldRepository->getList([
            'name' => $fieldName
        ]);
        $models = $this->buildModelList($list);
        $actions = [
            new Action(
                '+ Добавить',
                route('field.edit', [
                    'fieldName' => $fieldName,
                ])
            )
        ];

        return new ListWidget($models, $actions);
    }

    /**
     * @param Collection $list
     * 
     * @return Model[]
     */
    public function buildModelList(Collection $list): array
    {
        $result = [];
        if (!$list) {
            return $result;
        }

        foreach ($list as $item) {
            $result[$item->id] = $this->buildModelItem($item);
        }

        return $result;
    }

    /**
     * @param Field $item
     * 
     * @return Model
     */
    public function buildModelItem(Field $item): Model
    {
        $model = new Model(
            $item->name,
            $item->getCaption()
        );
        $model->setActions([
            new Action(
                'Редактировать',
                route('field.edit', [
                    'fieldName' => $item->name,
                    'modelId' => $item->id
                ])
            ),
            new Action(
                'Удалить',
                route('field.delete', [
                    'fieldName' => $item->name,
                    'modelId' => $item->id
                ])
            )
        ]);

        return $model;
    }

    /**
     * @param string $fieldName
     * @param int|null $id
     * 
     * @return Editor
     */
    public function getEditor(string $fieldName, ?int $id = null): Editor
    {
        $config = config('fields.forms.' . $fieldName);
        $editor = new Editor(
            __('admin.models.' . $fieldName . '.forms.default.title'),
            '',
            $this->getMessages()
        );

        $item = $this->getModelItem($fieldName, $id);
        $files = $this->getModelFiles($item);

        $formConfig = $this->prepareEditorFormConfig(
            $fieldName,
            $config['default'],
            $item,
            $files
        );
        $editor->setForm(Form::buildForm($formConfig));
        return $editor;
    }

    /**
     * @param string $fieldName
     * @param int $id
     * 
     * @return Editor
     */
    public function getDeletor(string $fieldName, int $id): Editor
    {
        $item = $this->getModelItem($fieldName, $id);

        $config = config('fields.forms.delete.default');
        $editor = new Editor(
            __('admin.fields.delete.default.title'),
            __('admin.fields.delete.default.note', [
                'name' => $item->getCaption()
            ]),
            $this->getMessages()
        );

        $formConfig = $this->prepareDeletorFormConfig($config);
        $editor->setForm(Form::buildForm($formConfig));
        return $editor;
    }

    /**
     * @param string $fieldName
     * @param int|null $id
     * @param array $input
     * 
     * @return Field
     */
    public function saveField(string $fieldName, ?int $id = null, array $input = []): Field
    {
        $item = $this->getModelItem($fieldName, $id);
        $item->fill($input);
        $this->fieldRepository->save($item);
        $this->messages = [
            __('admin.messages.model.saved')
        ];
        return $item;
    }

    /**
     * @param int $id
     * @param array $input
     * 
     * @return void
     */
    public function deleteField(int $id, array $input): void
    {
        $item = $this->fieldRepository->getItem(['id' => $id]);
        $this->fieldRepository->delete($item);
    }

    /* HELPERS */

    /**
     * @param string $fieldName
     * @param array $config
     * @param Field $item
     * @param array $filesMap
     * 
     * @return array
     */
    protected function prepareEditorFormConfig(
        string $fieldName,
        array $config,
        Field $item,
        array $filesMap = []
    ): array {
        $config['title'] = '';
        foreach ($config['fields'] as $key => $field) {
            $config['fields'][$key]['label'] = __('admin.fields.' . $fieldName . '.editors.default.fields.' . $field['name'] . '.label');
            $config['fields'][$key]['value'] = $item->{$field['name']};

            if ($field['type'] == 'files') {
                if ($item->id) {
                    $config['fields'][$key]['data']['uploadUrl'] = route(
                        'model.upload',
                        [
                            'modelName' => 'field',
                            'modelId' => $item->id
                        ]
                    );
                    $config['fields'][$key]['data']['filesMap'] = $filesMap;
                } else {
                    // нельзя загружать файлы к несозданной модели
                    unset($config['fields'][$key]);
                }
            }
        }

        $config['fields'][] = [
            'name' => 'save',
            'type' => 'submit',
            'label' => __('admin.forms.fields.save.label')
        ];

        return $config;
    }

    /**
     * @param string $modelName
     * @param array $config
     * @param Field $item
     * 
     * @return array
     */
    protected function prepareDeletorFormConfig(array $config): array
    {
        $config['title'] = '';
        $config['fields'][] = [
            'name' => 'delete',
            'type' => 'submit',
            'label' => __('admin.forms.fields.delete.label')
        ];

        return $config;
    }

    /**
     * @param string $fieldName
     * @param int|null $modelId
     * 
     * @return Field
     */
    protected function getModelItem(string $fieldName, ?int $modelId = null): Field
    {
        if ($modelId) {
            $item = $this->fieldRepository->getItem(['id' => $modelId]);
        } else {
            $item = $this->fieldRepository->getNewItem([
                'name' => $fieldName
            ]);
        }

        if (!$item) {
            throw new AdminModelNotFoundException(__('admin.messages.model.not-found'));
        }

        return $item;
    }

    /**
     * @param Field $item
     * 
     * @return array
     */
    protected function getModelFiles(Field $item): array
    {
        if (!$item->id) {
            // Новая моделька, еще не сохранили
            return [];
        }

        $files = $this->files->getModelFiles($item);
        $result = [];

        foreach ($files as $file) {
            switch ($file->type) {
                case File::TYPE_IMAGE:
                    $fileModel = ModelsImage::fromFile($file);
                    $fileModel->setActions([
                        new Action(
                            'Удалить',
                            route('field.edit', [
                                'fieldName' => $item->name,
                                'modelId' => $item->id,
                                'action' => 'delete-file',
                                'fileId' => $file->id
                            ]),
                            'delete'
                        ),
                        new Action(
                            'Вставить изображение',
                            ModelsImage::getImageSrcString($file, 'big'),
                            'insert-image'
                        )
                    ]);
                    break;
                default:
                    $fileModel = ModelsFile::fromFile($file);
                    $fileModel->setActions([
                        new Action(
                            'Удалить',
                            route('field.edit', [
                                'fieldName' => $item->name,
                                'modelId' => $item->id,
                                'action' => 'delete-file',
                                'fileId' => $file->id
                            ]),
                            'delete'
                        )
                    ]);
                    break;
            }

            $result[$file->type][] = $fileModel;
        }

        return $result;
    }
}
