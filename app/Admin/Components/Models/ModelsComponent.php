<?php

namespace App\Admin\Components\Models;

use App\Admin\Components\Common\Models\Link;
use App\Admin\Components\Files\Interfaces\FilesComponentInterface;
use App\Admin\Components\Models\Interfaces\ModelsComponentInterface;
use App\Admin\Components\Models\Models\Action;
use App\Admin\Components\Models\Models\Editor;
use App\Admin\Components\Models\Models\File as ModelsFile;
use App\Admin\Components\Models\Models\Image as ModelsImage;
use App\Admin\Components\Models\Models\Form;
use App\Admin\Components\Models\Models\ListWidget;
use App\Admin\Components\Models\Models\MenuWidget;
use App\Admin\Components\Models\Models\Model;
use App\Exceptions\AdminModelNotFoundException;
use App\Models\File;
use App\Repositories\RepositoryProvider;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class ModelsComponent implements ModelsComponentInterface
{
    private array $messages = [];

    /**
     * @var RepositoryProvider
     */
    protected RepositoryProvider $repositoryProvider;

    /**
     * @var FilesComponentInterface
     */
    protected FilesComponentInterface $files;

    public function __construct(
        RepositoryProvider $repositoryProvider,
        FilesComponentInterface $files
    ) {
        $this->repositoryProvider = $repositoryProvider;
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
     * @param string $modelName
     * @param array|null $filter
     * 
     * @return Model[]
     */
    public function getList(string $modelName, ?array $filter = null): ListWidget
    {
        $repository = $this->repositoryProvider->getRepository($modelName);
        $list = $repository->getList($filter);
        $models = $this->buildModelList($modelName, $list);
        $actions = [
            new Action(
                '+ Добавить',
                route(
                    'model.create',
                    array_merge(
                        ['modelName' => $modelName],
                        $filter ?: []
                    )
                )
            )
        ];

        return new ListWidget($models, $actions);
    }

    /**
     * @param string $modelName
     * @param Collection $list
     * 
     * @return Model[]
     */
    public function buildModelList(string $modelName, Collection $list): array
    {
        $result = [];

        foreach ($list as $item) {
            $result[] = $this->buildModelItem($item);
        }

        return $result;
    }

    /**
     * @param EloquentModel $item
     * 
     * @return Model
     */
    public function buildModelItem(EloquentModel $item): Model
    {
        $model = new Model(
            $item::MODEL_NAME,
            $item->getCaption()
        );
        $model->setActions($this->getModelItemActions($item));

        return $model;
    }

    /**
     * @param string $modelName
     * 
     * @return Link
     */
    public function getListLink(string $modelName): Link
    {
        return new Link(
            __('admin.links.model.list'),
            route('model.list', [
                'modelName' => $modelName
            ])
        );
    }

    /**
     * @param string $modelName
     * @param int $modelId
     * 
     * @return Editor
     */
    public function getEditor(string $modelName, int $modelId): Editor
    {
        $config = config('models.editors.' . $modelName);
        $editor = new Editor(
            __('admin.models.' . $modelName . '.editors.default.title'),
            '',
            $this->getMessages()
        );

        $item = $this->getModelItem($modelName, $modelId);
        $files = $this->getModelFiles($item);

        $formConfig = $this->prepareEditorFormConfig(
            $modelName,
            $config['default']['form'],
            $item,
            $files
        );
        $editor->setForm(Form::buildForm($formConfig));
        return $editor;
    }

    /**
     * @param string $modelName
     * 
     * @return Editor
     */
    public function getCreator(string $modelName): Editor
    {
        $config = config('models.editors.' . $modelName);
        $editor = new Editor(
            __('admin.models.' . $modelName . '.editors.default.title'),
            '',
            $this->getMessages()
        );

        $item = $this->getNewModelItem($modelName);

        $formConfig = $this->prepareEditorFormConfig(
            $modelName,
            $config['create']['form'] ?? $config['default']['form'],
            $item
        );
        $editor->setForm(Form::buildForm($formConfig));
        return $editor;
    }

    /**
     * @param string $modelName
     * @param int $modelId
     * 
     * @return Editor
     */
    public function getDeletor(string $modelName, int $modelId): Editor
    {
        $item = $this->getModelItem($modelName, $modelId);

        $config = config('models.deletors.default');
        $editor = new Editor(
            __('admin.models.' . $modelName . '.deletors.default.title'),
            __('admin.models.' . $modelName . '.deletors.default.note', [
                'name' => $item->caption
            ]),
            $this->getMessages()
        );

        $formConfig = $this->prepareDeletorFormConfig($config['form']);
        $editor->setForm(Form::buildForm($formConfig));
        return $editor;
    }

    /**
     * @return MenuWidget
     */
    public function getMenu(): MenuWidget
    {
        // надо получить список существующих моделей
        $modelNames = $this->getModelNames();

        $links = [];
        foreach ($modelNames as $modelName) {
            $links[] = new Link(
                __('admin.models.' . $modelName . '.name-plural'),
                route('model.list', ['modelName' => $modelName])
            );
        }

        return new MenuWidget($links);
    }

    /**
     * @param string $modelName
     * @param int $modelId
     * @param array $input
     * 
     * @return EloquentModel
     */
    public function editModel(string $modelName, int $modelId, array $input): EloquentModel
    {
        $item = $this->getModelItem($modelName, $modelId);
        $item->fill($input);
        $this->saveItem($item);
        $this->messages = [
            __('admin.messages.model.saved')
        ];
        return $item;
    }

    /**
     * @param string $modelName
     * @param array $input
     * 
     * @return EloquentModel
     */
    public function createModel(string $modelName, array $input): EloquentModel
    {
        $item = $this->getNewModelItem($modelName, $input);
        $this->saveItem($item);
        $this->messages = [
            __('admin.messages.model.saved')
        ];
        return $item;
    }

    /**
     * @param string $modelName
     * @param int $modelId
     * @param array $input
     * 
     * @return void
     */
    public function deleteModel(string $modelName, int $modelId, array $input): void
    {
        $item = $this->getModelItem($modelName, $modelId);
        $this->deleteItem($item);
    }

    /* HELPERS */

    /**
     * @param string $modelName
     * @param array $config
     * @param EloquentModel $item
     * @param array $filesMap
     * 
     * @return array
     */
    protected function prepareEditorFormConfig(
        string $modelName,
        array $config,
        EloquentModel $item,
        array $filesMap = []
    ): array {
        $config['title'] = '';
        foreach ($config['fields'] as $key => $field) {
            $config['fields'][$key]['label'] = __('admin.models.' . $modelName . '.editors.default.fields.' . $field['name'] . '.label');
            $config['fields'][$key]['value'] = $item->{$field['name']};

            if ($field['type'] == 'files') {
                $config['fields'][$key]['data']['uploadUrl'] = route(
                    'model.upload',
                    [
                        'modelName' => $modelName,
                        'modelId' => $item->id
                    ]
                );
                $config['fields'][$key]['data']['filesMap'] = $filesMap;
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
     * @param EloquentModel $item
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
     * @param string $modelName
     * @param string $modelId
     * 
     * @return EloquentModel
     */
    protected function getModelItem(string $modelName, string $modelId): EloquentModel
    {
        $repository = $this->repositoryProvider->getRepository($modelName);
        $item = $repository->getItem(['id' => $modelId]);

        if (!$item) {
            throw new AdminModelNotFoundException(__('admin.messages.model.not-found'));
        }

        return $item;
    }

    /**
     * @param string $modelName
     * 
     * @return EloquentModel
     */
    protected function getNewModelItem(string $modelName, array $attributes = []): EloquentModel
    {
        $repository = $this->repositoryProvider->getRepository($modelName);
        return $repository->getNewItem($attributes);
    }

    /**
     * @param EloquentModel $item
     * 
     * @return array
     */
    protected function getModelFiles(EloquentModel $item): array
    {
        $files = $this->files->getModelFiles($item);

        $result = [];

        foreach ($files as $file) {
            switch ($file->type) {
                case File::TYPE_IMAGE:
                    $fileModel = ModelsImage::fromFile($file);
                    $fileModel->setActions([
                        new Action(
                            'Удалить',
                            route('model.edit', [
                                'modelName' => $item::MODEL_NAME,
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
                            route('model.edit', [
                                'modelName' => $item::MODEL_NAME,
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

    /**
     * @param EloquentModel $item
     * 
     * @return void
     */
    protected function saveItem(EloquentModel $item): void
    {
        $repository = $this->repositoryProvider->getRepository($item::MODEL_NAME);
        $repository->save($item);
    }

    /**
     * @param EloquentModel $item
     * 
     * @return void
     */
    protected function deleteItem(EloquentModel $item): void
    {
        $repository = $this->repositoryProvider->getRepository($item::MODEL_NAME);
        $repository->delete($item);
    }

    /**
     * @return array
     */
    protected function getModelNames(): array
    {
        $repositoriesConfig = config('models.repositories', []);
        return array_keys($repositoriesConfig);
    }

    /**
     * @param EloquentModel $model
     * 
     * @return array
     */
    protected function getModelItemActions(EloquentModel $model): array
    {
        $actionsConfig = config('models.actions.' . $model::MODEL_NAME) ?: config('models.actions.default') ?: [];
        $actions = [];

        foreach ($actionsConfig as $key => $value) {
            if (is_numeric($key)) {
                $name = $value;
                $params = config('models.actions.default.' . $name);
            } else {
                $name = $key;
                $params = $value;
            }

            $routeParams = $params['route'];
            $routeName = array_shift($routeParams);
            $routeParamsMap = $params['routeParams'] ?? [];
            foreach ($routeParamsMap as $attribute => $paramName) {
                $routeParams[$paramName] = $model->getAttribute($attribute);
            }
            if (!($routeParams['modelName'] ?? null)) {
                $routeParams['modelName'] = $model::MODEL_NAME;
            }

            $actions[] = new Action(
                __('admin.actions.' . $name),
                route($routeName, $routeParams)
            );
        }

        return $actions;
    }
}
