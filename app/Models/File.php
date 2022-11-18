<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class File extends Model
{
    use HasFactory;

    const TABLE_NAME = 'files';
    const MODEL_NAME = 'file';

    const TYPE_IMAGE = 'image';
    const TYPE_FILE = 'file';
    const EXTENSION_TYPES = [
        'jpg' => self::TYPE_IMAGE,
        'jpeg' => self::TYPE_IMAGE,
        'gif' => self::TYPE_IMAGE,
        'png' => self::TYPE_IMAGE,
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_HIDDEN = 2;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'hash',
        'ext',
        'size',
        'type',
        'status',
    ];

    /**
     * @return HasMany
     */
    public function references(): HasMany
    {
        return $this->hasMeny(FileReference::class, 'file_id', 'id');
    }

    /**
     * @return Collection
     */
    public function getReferences(): Collection
    {
        return $this->references()->get();
    }

    public function getCaption(): string
    {
        return $this->name;
    }

    public function setTypeByExtension(string $ext): void
    {
        $this->type = self::EXTENSION_TYPES[$ext] ?? self::TYPE_FILE;
    }
}
