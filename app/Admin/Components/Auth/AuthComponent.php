<?php

namespace App\Admin\Components\Auth;

use App\Admin\Components\Auth\Interfaces\AuthComponentInterface;
use App\Admin\Components\Auth\Models\LoginDataObject;
use Components\DataObjectManager\Interfaces\DataObjectManagerInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use TypeError;

class AuthComponent implements AuthComponentInterface
{
    public function __construct(
        DataObjectManagerInterface $dataObjectManager
    ) {
        $this->dataObjectManager = $dataObjectManager;
    }

    /**
     * @param array $credentials
     * 
     * @return bool
     */
    public function login(array $credentials): bool
    {
        try {
            $loginDataObject = LoginDataObject::fromArray($credentials);
        } catch (TypeError $error) {
            throw ValidationException::withMessages([
                'Необходимо заполнить все поля'
            ]);
        }

        $this->dataObjectManager->validateDataObject($loginDataObject);

        if (!Auth::attempt($loginDataObject->toArray())) {
            throw ValidationException::withMessages([
                'Неверный логин или пароль'
            ]);
        }

        return true;
    }

    /**
     * @return bool
     */
    public function logout(): bool
    {
        Auth::logout();
        return true;
    }
}
