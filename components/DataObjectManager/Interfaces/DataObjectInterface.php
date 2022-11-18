<?php

namespace Components\DataObjectManager\Interfaces;

interface DataObjectInterface
{
    /**
     * @return array
     */
    public static function getRules(): array;

    /**
     * @param array $array
     * 
     * @return static
     */
    public static function fromArray(array $array): static;

    /**
     * @return array
     */
    public function toArray(): array;
}
