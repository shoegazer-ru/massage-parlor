<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FileReference extends Model
{
    use HasFactory;

    const TABLE_NAME = 'files_references';
    const MODEL_NAME = 'file_reference';

    /**
     * @var string
     */
    protected $table = self::TABLE_NAME;

    /**
     * @var array
     */
    protected $fillable = [
        'file_id',
        'model_name',
        'model_id',
        'sort_index',
        'type',
    ];

    /**
     * @return BelongsTo
     */
    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }

    /**
     * @return File|null
     */
    public function getFile(): ?File
    {
        return $this->file()->first();
    }

    /**
     * @param File $file
     * 
     * @return void
     */
    public function setFile(File $file): void
    {
        $this->file()->associate($file);
    }

    /**
     * @param Model $model
     * 
     * @return void
     */
    public function setModel(Model $model): void
    {
        $this->model_name = $model::MODEL_NAME;
        $this->model_id = $model->id;
    }

    public function setSortIndex(): void
    {
        // ищем модель с максимальным sort_index
        $targetFile = self::where([
            'model_name' => $this->model_name,
            'model_id' => $this->model_id
        ])->orderBy('sort_index', 'desc')->first();

        if (!$targetFile) {
            $this->sort_index = 0;
        } else {
            $this->sort_index = $targetFile->sort_index + 1;
        }
    }

    public function getCaption()
    {
        return $this->model_name . '-' . $this->model_id . '-' . $this->file_id;
    }
}
