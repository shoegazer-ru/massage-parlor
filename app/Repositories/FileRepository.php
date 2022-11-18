<?php

namespace App\Repositories;

use App\Models\File;
use Components\Repository\AbstractRepository;
use Illuminate\Database\Eloquent\Collection;

class FileRepository extends AbstractRepository
{
    /**
     * @return self
     */
    public function __construct()
    {
        $this->modelClass = File::class;
    }

    public function getNewItem(array $attributes = []): File
    {
        $item = parent::getNewItem($attributes);
        if (!$item->status) {
            $item->status = File::STATUS_ACTIVE;
        }

        return $item;
    }

    /**
     * @param Collection $references
     * 
     * @return array
     */
    public function getReferencesList(Collection $references): array
    {
        $files = $this->getList([
            'id' => $references->pluck('file_id')->toArray()
        ]);

        $files = $this->idToKey($files);

        $result = [];

        foreach ($references as $reference) {
            $result[] = $files[$reference->file_id] ?? null;
        }

        return array_filter($result);
    }

    /**
     * @param Collection $list
     * 
     * @return array
     */
    protected function idToKey(Collection $list): array
    {
        $result = [];
        foreach ($list as $item) {
            $result[$item->id] = $item;
        }

        return $result;
    }
}
