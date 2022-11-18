<?php

namespace Components\DataObjectManager\Interfaces;

interface DataObjectManagerInterface
{
    /**
     * @param DataObjectInterface $dataObject
     * 
     * @return void
     */
    public function validateDataObject(DataObjectInterface $dataObject): void;
}
