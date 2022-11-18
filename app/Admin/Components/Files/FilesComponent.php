<?php

namespace App\Admin\Components\Files;

use App\Admin\Components\Files\Interfaces\FilesComponentInterface;
use App\Exceptions\AdminModelNotFoundException;
use App\Models\File;
use App\Repositories\RepositoryProvider;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Image;

class FilesComponent implements FilesComponentInterface
{
    /**
     * @var RepositoryProvider
     */
    protected RepositoryProvider $repositoryProvider;

    public function __construct(
        RepositoryProvider $repositoryProvider
    ) {
        $this->repositoryProvider = $repositoryProvider;
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param string $modelName
     * @param int $modelId
     * 
     * @return void
     */
    public function uploadFile(UploadedFile $uploadedFile, string $modelName, int $modelId): void
    {
        // @todo Вынести функционал в отдельный компонент
        $fileRepository = $this->repositoryProvider->getRepository('file');
        $fileReferenceRepository = $this->repositoryProvider->getRepository('file_reference');
        $item = $this->getModelItem($modelName, $modelId);

        $file = $fileRepository->getNewItem();
        $file->fill([
            'name' => $uploadedFile->getClientOriginalName(),
            'hash' => Str::random(60),
            'ext' => $uploadedFile->getClientOriginalExtension(),
            'size' => $uploadedFile->getSize(),
        ]);

        $file->setTypeByExtension($file->ext);

        $fileRepository->save($file);
        $fileReferenceRepository->createFileReference($file, $item);

        if ($file->type == File::TYPE_IMAGE) {
            $sizes = config('files.sizes');
            foreach ($sizes as $sizeName => $sizeParams) {
                $fileDir = 'uploads/images/' . $sizeName . '/' . substr($file->hash, 0, 2);
                if (!file_exists($fileDir)) {
                    mkdir($fileDir, 0755, true);
                }
                $img = Image::make($uploadedFile->path());
                $action = $sizeParams[2] ?? null;
                switch ($action) {
                    case 'fit':
                        $img->fit($sizeParams[0], $sizeParams[1], function ($const) {
                            $const->aspectRatio();
                        });
                        break;
                    default:
                        $img->resize($sizeParams[0], $sizeParams[1], function ($const) {
                            $const->aspectRatio();
                        });
                        break;
                }
                $img->save($fileDir . '/' . $file->hash . '.' . $file->ext, 90);
            }
        } else {
            $uploadedFile->move('uploads/files/' . substr($file->hash, 0, 2), $file->hash . '.' . $file->ext);
        }
    }

    /**
     * @param int $fileId
     * 
     * @return void
     */
    public function deleteFile(int $fileId): void
    {
        $fileRepository = $this->repositoryProvider->getRepository('file');
        $fileReferenceRepository = $this->repositoryProvider->getRepository('file_reference');

        $reference = $fileReferenceRepository->getItem(['file_id' => $fileId]);
        if ($reference) {
            $fileReferenceRepository->delete($reference);
        }

        $file = $fileRepository->getItem(['id' => $fileId]);
        if ($file) {
            $fileRepository->delete($file);

            switch ($file->type) {
                case $file::TYPE_IMAGE:
                    $sizes = config('files.sizes');
                    foreach ($sizes as $sizeName => $sizeParams) {
                        $filePath = $this->getImagePath($file, $sizeName);
                        unlink($filePath);
                    }
                    break;
                default:
                    $filePath = $this->getFilePath($file);
                    unlink($filePath);
                    break;
            }
        }
    }

    /**
     * @param Model $model
     * 
     * @return File[]
     */
    public function getModelFiles(Model $model): array
    {
        $referenceRepository = $this->repositoryProvider->getRepository('file_reference');
        $fileRepository = $this->repositoryProvider->getRepository('file');

        $references = $referenceRepository->getList([
            'model_name' => $model::MODEL_NAME,
            'model_id' => $model->id
        ], 'sort_index');

        if (!$references) {
            return [];
        }

        return $fileRepository->getReferencesList($references);
    }

    /**
     * @param File $file
     * 
     * @return string
     */
    public function getFilePath(File $file): string
    {
        return public_path('uploads/files/' . substr($file->hash, 0, 2) . '/' . $file->hash . '.' . $file->ext);
    }

    /**
     * @param File $file
     * @param string $sizeName
     * 
     * @return string
     */
    public function getImagePath(File $file, string $sizeName): string
    {
        return public_path('uploads/images/' . $sizeName . '/' . substr($file->hash, 0, 2) . '/' . $file->hash . '.' . $file->ext);
    }

    /* HELPERS */

    /**
     * @param string $modelName
     * @param string $modelId
     * 
     * @return Model
     */
    protected function getModelItem(string $modelName, string $modelId): Model
    {
        $repository = $this->repositoryProvider->getRepository($modelName);
        $item = $repository->getItem(['id' => $modelId]);

        if (!$item) {
            throw new AdminModelNotFoundException(__('admin.messages.model.not-found'));
        }

        return $item;
    }
}
