<?php

declare(strict_types=1);

namespace Components\DataObjectManager\Validators;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class DataObjectValidator
{
    protected array $errors;

    /**
     * @return self
     */
    public function __construct()
    {
        $this->errors = [];
    }

    /**
     * @inheritDoc
     *
     * @throws ValidationException
     */
    public function validate(array $attributes, array $rules): static
    {
        $validator = Validator::make($attributes, $rules);
        if ($validator->errors()->isNotEmpty()) {
            throw new ValidationException($validator);
        }

        return $this;
    }
}
