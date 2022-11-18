<?php

namespace Components\DataObjectManager;

use Components\DataObjectManager\Interfaces\DataObjectInterface;
use Components\DataObjectManager\Interfaces\DataObjectManagerInterface;
use Components\DataObjectManager\Validators\DataObjectValidator;

class DataObjectManager implements DataObjectManagerInterface
{
    public function __construct(
        DataObjectValidator $validator
    ) {
        $this->validator = $validator;
    }

    /**
     * @param DataObjectInterface $dataObject
     * 
     * @return void
     */
    public function validateDataObject(DataObjectInterface $dataObject): void
    {
        $this->validator->validate($dataObject->toArray(), $dataObject::getRules());
    }
}
