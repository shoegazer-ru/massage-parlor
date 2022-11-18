<?php

namespace Components\Repository;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    protected string $modelClass;

    public function getList(?array $filter = null, ?string $sort = null)
    {
        $query = $this->buildQuery($filter, $sort);
        return $query->get();
    }

    public function getItem(?array $filter = null)
    {
        $query = $this->buildQuery($filter);
        return $query->first();
    }

    public function getNewItem(array $attributes = [])
    {
        $item = new ($this->modelClass)();
        $item->fill($attributes);
        return $item;
    }

    public function getCount(?array $filter = null)
    {
        return $this->getList($filter)->count();
    }

    public function save(Model $item): void
    {
        $item->save();
    }

    public function delete(Model $item): void
    {
        $item->delete();
    }

    /* HELPERS */

    /**
     * @param array|null $filter
     * @param string|null $sort
     * 
     * @return Builder
     */
    protected function buildQuery(?array $filter = null, ?string $sort = null): Builder
    {
        $query = $this->modelClass::query();

        if ($filter) {
            foreach ($filter as $key => $value) {
                if (is_array($value)) {
                    $query->whereIn($key, $value);
                } else {
                    $query->where($key, $value);
                }
            }
        }

        if ($sort) {
            $query->orderBy($sort);
        }

        return $query;
    }
}
