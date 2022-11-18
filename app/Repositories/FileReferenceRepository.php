<?php

namespace App\Repositories;

use App\Models\File;
use App\Models\FileReference;
use Components\Repository\AbstractRepository;
use Illuminate\Database\Eloquent\Model;

class FileReferenceRepository extends AbstractRepository
{
    /**
     * @return self
     */
    public function __construct()
    {
        $this->modelClass = FileReference::class;
    }

    /**
     * @param File $file
     * @param Model $model
     * @param array $params
     * 
     * @return FileReference
     */
    public function createFileReference(File $file, Model $model, array $params = []): FileReference
    {
        $fileReference = new FileReference($params);
        $fileReference->setFile($file);
        $fileReference->setModel($model);
        $fileReference->setSortIndex();
        $fileReference->save();

        return $fileReference;
    }
}
