<?php

namespace App\Repositories;

use App\Models\Section;
use Components\Repository\AbstractRepository;

class SectionRepository extends AbstractRepository
{
    /**
     * @return self
     */
    public function __construct()
    {
        $this->modelClass = Section::class;
    }
}
