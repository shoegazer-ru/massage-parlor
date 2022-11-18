<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Field extends Model
{
    use HasFactory;

    const TABLE_NAME = 'fields';
    const MODEL_NAME = 'field';

    /**
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'name',
        'date',
        'caption',
        'value',
        'body',
        'data'
    ];

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Field::class, 'parent_id', 'id');
    }

    /**
     * @return Field|null
     */
    public function getParent(): ?Field
    {
        return $this->parent()->first();
    }

    /**
     * @param Field $field
     * 
     * @return void
     */
    public function setParent(Field $field): void
    {
        $this->parent()->associate($field);
    }

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMeny(Field::class, 'parent_id', 'id');
    }

    /**
     * @return Collection
     */
    public function getChildren(): Collection
    {
        return $this->children()->get();
    }

    public function getCaption(): string
    {
        return $this->caption ?: $this->name;
    }
}
