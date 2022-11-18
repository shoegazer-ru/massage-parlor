<?php

namespace App\Repositories;

use App\Models\Field;
use Components\Repository\AbstractRepository;

class FieldRepository extends AbstractRepository
{
    /**
     * @return self
     */
    public function __construct()
    {
        $this->modelClass = Field::class;
    }
}
