<?php

namespace App\Admin\Components\Auth\Interfaces;

use Exception;
use TypeError;

interface AuthComponentInterface
{
    /**
     * @param array $credentials
     * 
     * @return bool
     */
    public function login(array $credentials): bool;

    /**
     * @return bool
     */
    public function logout(): bool;
}
