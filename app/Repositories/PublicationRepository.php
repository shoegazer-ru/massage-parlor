<?php

namespace App\Repositories;

use App\Models\Publication;
use Components\Repository\AbstractRepository;

class PublicationRepository extends AbstractRepository
{
    /**
     * @return self
     */
    public function __construct()
    {
        $this->modelClass = Publication::class;
    }
}
