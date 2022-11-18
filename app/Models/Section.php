<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    use HasFactory;

    const TABLE_NAME = 'sections';
    const MODEL_NAME = 'section';

    /**
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'caption',
        'body',
        'url'
    ];

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'parent_id', 'id');
    }

    /**
     * @return Section|null
     */
    public function getParent(): ?Section
    {
        return $this->parent()->first();
    }

    /**
     * @param Section $section
     * 
     * @return void
     */
    public function setParent(Section $section): void
    {
        $this->parent()->associate($section);
    }

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMeny(Section::class, 'parent_id', 'id');
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
        return $this->caption;
    }
}
