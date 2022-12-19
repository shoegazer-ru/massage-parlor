<?php

namespace App\Components\ModelProvider;

use App\Components\ModelProvider\Interfaces\ModelProviderComponentInterface;
use App\Components\ModelProvider\Models\ModelFile;
use App\Components\ModelProvider\Models\ModelImage;
use App\Components\ModelProvider\Models\ModelItem;
use App\Models\File;
use App\Models\FileReference;
use App\Repositories\RepositoryProvider;
use Components\Repository\AbstractRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ModelProviderComponent implements ModelProviderComponentInterface
{
    /**
     * @var RepositoryProvider
     */
    protected RepositoryProvider $repositoryProvider;

    /**
     * @param RepositoryProvider $repositoryProvider
     */
    public function __construct(RepositoryProvider $repositoryProvider)
    {
        $this->repositoryProvider = $repositoryProvider;
    }

    /**
     * @param string $modelName
     * @param array $criteria
     * @param array $referencesConfig
     * 
     * @return ModelItem[]
     */
    public function getList(string $modelName, array $criteria = [], array $referencesConfig = []): array
    {
        $list = [];

        $repository = $this->getRepository($modelName);
        $repositoryItems = $repository->getList($criteria['filter'] ?? null, $criteria['sort'] ?? null);

        $itemsReferences = $this->getItemsReferences($repositoryItems, $referencesConfig);

        foreach ($repositoryItems as $repositoryItem) {
            $list[] = $this->buildModelItem(
                $repositoryItem,
                $itemsReferences[$repositoryItem->id] ?? []
            );
        }

        return $list;
    }

    /**
     * @param string $modelName
     * @param array $criteria
     * @param array $referencesConfig
     * 
     * @return ModelItem
     */
    public function getItem(string $modelName, array $criteria = [], array $referencesConfig = []): ModelItem
    {
        $repository = $this->getRepository($modelName);
        $repositoryItem = $repository->getItem($criteria['filter'] ?? null);

        return $this->buildModelItem($repositoryItem);
    }

    /**
     * @param string $modelName
     * 
     * @return AbstractRepository
     */
    protected function getRepository(string $modelName): AbstractRepository
    {
        return $this->repositoryProvider->getRepository($modelName);
    }

    /**
     * @param Model $model
     * @param array $references
     * 
     * @return ModelItem
     */
    protected function buildModelItem(Model $model, array $references): ModelItem
    {
        $modelItem = new ModelItem($model, $references);

        return $modelItem;
    }

    /**
     * @param Collection $items
     * @param array $referencesConfig
     * 
     * @return array
     */
    protected function getItemsReferences(Collection $items, array $referencesConfig): array
    {
        $references = [];

        if ($items->isEmpty()) {
            return $references;
        }

        foreach ($referencesConfig as $key => $value) {
            if (is_numeric($key)) {
                $name = $value;
                $config = [];
            } else {
                $name = $key;
                $config = $value;
            }

            $references[$name] = $this->getItemsReference($items, $name, $config);
        }

        $result = [];

        foreach ($references as $referenceName => $referenceData) {
            foreach ($referenceData as $modelId => $modelData) {
                $result[$modelId][$referenceName] = $modelData;
            }
        }

        return $result;
    }

    /**
     * @param Collection $items
     * @param string $name
     * @param array $config
     * 
     * @return array
     */
    protected function getItemsReference(Collection $items, string $name, array $config = []): array
    {
        switch ($name) {
            case self::FILES:
                return $this->getItemsFiles($items, $config);
        }

        return [];
    }

    /**
     * @param Collection $items
     * @param array $config
     * 
     * @return array
     */
    protected function getItemsFiles(Collection $items, array $config = []): array
    {
        $ids = $items->pluck('id')->toArray();
        $model = $items->first(); // для получения некоторых данных

        $referenceRepository = $this->repositoryProvider->getRepository('file_reference');
        $fileRepository = $this->repositoryProvider->getRepository('file');

        $references = $referenceRepository->getList([
            'model_name' => $model::MODEL_NAME,
            'model_id' => $ids
        ], 'sort_index');

        if (!$references) {
            return [];
        }

        $files = $this->objectsFieldAsKey($fileRepository->getReferencesList($references), 'id');

        $itemsFiles = [];
        foreach ($references as $reference) {
            $file = $files[$reference->file_id];
            switch ($file->type) {
                case File::TYPE_FILE:
                    $itemsFiles[$reference->model_id][$file->type] = $this->buildFile($file, $reference);
                    break;
                case File::TYPE_IMAGE:
                    $itemsFiles[$reference->model_id][$file->type] = $this->buildImage($file, $reference);
                    break;
            }
        }

        return $itemsFiles;
    }

    protected function buildFile(File $file, FileReference $fileReference): ModelFile
    {
        return new ModelFile(
            $file->name,
            $file->ext,
            route('files.download', ['id' => $file->id]) // @todo: сделать абстрактный построитель урлов
        );
    }

    protected function buildImage(File $file, FileReference $fileReference): ModelImage
    {
        return new ModelImage(
            $file->name,
            $file->ext,
            asset('/uploads/images/big/' . substr($file->hash, 0, 2) . '/' . $file->hash . '.' . $file->ext), // @todo: абстрактный построитель урлов + абстрактный построитель урлов до файлов
            asset('/uploads/images/thumb/' . substr($file->hash, 0, 2) . '/' . $file->hash . '.' . $file->ext)
        );
    }

    protected function objectsFieldAsKey($objects, $key)
    {
        $result = [];

        foreach ($objects as $object) {
            $result[$object->{$key}] = $object;
        }

        return $result;
    }
}
