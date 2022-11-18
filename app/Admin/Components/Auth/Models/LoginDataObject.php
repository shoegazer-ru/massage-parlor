<?php

declare(strict_types=1);

namespace App\Admin\Components\Auth\Models;

use Components\DataObjectManager\Interfaces\DataObjectInterface;

class LoginDataObject implements DataObjectInterface
{
    private string $name;
    private string $password;

    /**
     * @param string $name
     * @param string $password
     */
    public function __construct(string $name, string $password)
    {
        $this->name = $name;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return array
     */
    public static function getRules(): array
    {
        return [
            'name' => [
                'required'
            ],
            'password' => [
                'required'
            ]
        ];
    }

    /**
     * @return static
     */
    public static function fromArray(array $array): static
    {
        return new static(
            $array['name'] ?? null,
            $array['password'] ?? null
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'password' => $this->getPassword()
        ];
    }
}
