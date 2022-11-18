<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Publication extends Model
{
    use HasFactory;

    const TABLE_NAME = 'publications';
    const MODEL_NAME = 'publication';

    /**
     * @var array
     */
    protected $fillable = [
        'section_id',
        'date',
        'caption',
        'annotation',
        'body',
    ];

    /**
     * @return BelongsTo
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    /**
     * @return Section|null
     */
    public function getSection(): ?Section
    {
        return $this->section()->first();
    }

    /**
     * @param Section $section
     * 
     * @return void
     */
    public function setSection(Section $section): void
    {
        $this->section()->associate($section);
    }

    public function getCaption(): string
    {
        return $this->caption;
    }
}
