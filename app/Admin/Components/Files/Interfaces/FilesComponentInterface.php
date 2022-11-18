<?php

namespace App\Admin\Components\Files\Interfaces;

use App\Models\File;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

interface FilesComponentInterface
{
    /**
     * @param UploadedFile $uploadedFile
     * @param string $modelName
     * @param int $modelId
     * 
     * @return void
     */
    public function uploadFile(UploadedFile $uploadedFile, string $modelName, int $modelId): void;

    /**
     * @param int $fileId
     * 
     * @return void
     */
    public function deleteFile(int $fileId): void;

    /**
     * @param Model $model
     * 
     * @return File[]
     */
    public function getModelFiles(Model $model): array;

    /**
     * @param File $file
     * 
     * @return string
     */
    public function getFilePath(File $file): string;

    /**
     * @param File $file
     * @param string $sizeName
     * 
     * @return string
     */
    public function getImagePath(File $file, string $sizeName): string;
}
